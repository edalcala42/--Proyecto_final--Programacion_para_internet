<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genero;
use App\Models\Juego;
use App\Models\Imagen;
use App\Models\Comentario;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\TicketJuegoAdquirido;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class JuegoController extends Controller
{
    public function __construct()
    {
        #$this->middleware('auth')->except('index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(Request $request)
    {
        $juegos = Juego::All();
        $imagenes = Imagen::All();
        return view('admin_show_all_juegos', compact('juegos', 'imagenes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function create(Request $request)
    {
        if($request->user()){
            $request->user()->authorizeRoles('Administrador');
            $generos = Genero::All();
            return view('admin_crear_juego', compact('generos'));
        }
        else{
            abort(401, 'No estás autorizado para realizar esta acción');
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(Request $request)
    {
        // Validar datos
        $request->validate([
            'titulo' => 'required|max:100|unique:App\Models\Juego,titulo',
            'fecha_de_publicacion' => 'required',
            'empresa_editora' => 'required|max:255',
            'descripcion' => 'required',
        ]);

        $icono = $request->file('imagen');
        $nombre_icono = time().$icono->getClientOriginalName();
        $icono->store('imagenes', ['disk' => 'my_files']);
        #$icono->move(public_path().'/imagenes/', $nombre_icono);

        $mime = $request->imagen->getClientMimeType();
        $nombre_original = $request->imagen->getClientOriginalName();
        $ruta = $request->imagen->store('images', ['disk' => 'my_files']);
        
        $request->merge([
            'imagen_original' => $nombre_original,
            'imagen_ruta' => $ruta,
            'mime' => $mime,
            'user_id' => Auth::id(),
            'icono' => $nombre_icono,
        ]);
        
        #$juego = Juego::create($request->except('_token', '_method', 'genero_id', 'imagen'));

        $juego = new Juego();
        $juego->user_id = $request->user_id;
        $juego->titulo = $request->titulo;
        $juego->descripcion = $request->descripcion;
        $juego->fecha_de_publicacion = $request->fecha_de_publicacion;
        $juego->empresa_editora = $request->empresa_editora;
        $juego->precio = $request->precio;
        $juego->icono = $request->icono;
        $juego->save();
        $juego->generos()->attach($request->genero_id);

        $imagenTable = new Imagen();  
        $imagenTable->juego_id = $juego->id;
        $imagenTable->imagen_original = $request->imagen_original; 
        $imagenTable->imagen_ruta = $request->imagen_ruta; 
        $imagenTable->mime = $request->mime; 
        $imagenTable->save(); 

        $juego->imagenes()->save($imagenTable);
        
        return redirect()->route('juegos.index')->with('message', '¡Se agregó el nuevo juego con éxito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Juego  $juego
     * @return \Illuminate\Http\Response
     */
    
    public function show(Juego $juego, Request $request)
    {
        $comentarios = Comentario::where('juego_id', $juego->id)->get();
        if($request->user()){    
            if($request->user()->hasRole('Administrador')){
                $sesion_admin = 1;
                $editar = 1;
                return view('admin_show_juego', compact('juego', 'editar', 'sesion_admin', 'comentarios'));
            }
            else{
                $sesion_usuario = 1;
                return view('admin_show_juego', compact('juego', 'sesion_usuario', 'comentarios'));
            }
        }
        else{
            $sesion_invitado = 1;
            return view('admin_show_juego', compact('juego', 'sesion_invitado', 'comentarios'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Juego  $juego
     * @return \Illuminate\Http\Response
     */
    
    public function storeComentario(Request $request, Juego $juego){
        $request->merge([
            'user_id' => Auth::id(),
            'comentario' => $request->comentario ?? 'hello',
        ]);
        $comentarioTable = new Comentario();
        $comentarioTable->user_id = $request->user_id;
        $comentarioTable->juego_id = $juego->id;
        $comentarioTable->comentario = $request->comentario;
        $comentarioTable->save();

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Juego  $juego
     * @return \Illuminate\Http\Response
     */

    public function edit(Juego $juego, Request $request)
    {
        if($request->user()){
            $request->user()->authorizeRoles('Administrador');
            $generos = Genero::All();
            return view('admin_update_juego', compact('juego', 'generos'));
        }
        else{
            abort(401, 'No estás autorizado para realizar esta acción');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Juego  $juego
     * @return \Illuminate\Http\Response
     */
    
    public function update(Request $request, Juego $juego)
    {
        // Validar datos
        $request->validate([
            'titulo' => [
                'required', 
                Rule::unique('juegos')->ignore($juego),
            ],
            'fecha_de_publicacion' => 'required',
            'empresa_editora' => 'required|max:255',
        ]);
        
        #$image_just_in_case = Imagen::where('juego_id', $juego->id)->first();
        if($request->imagen === null){
            $ruta = Imagen::where('juego_id', $juego->id)->first()->imagen_ruta;
            $mime = Imagen::where('juego_id', $juego->id)->first()->mime;
            $nombre_original = Imagen::where('juego_id', $juego->id)->first()->imagen_original;
        }
        else{
            $ruta = $request->imagen->store();
            $mime = $request->imagen->getClientMimeType();
            $nombre_original = $request->imagen->getClientOriginalName();
        }

        $request->merge([
            'user_id' => $juego->user_id,
            'descripcion' => $request->descripcion ?? $juego->descripcion,
            'imagen_original' => $nombre_original,
            'imagen_ruta' => $ruta,
            'mime' => $mime,
            #'imagen' => $request->imagen ?? $image_just_in_case,
        ]);
        Juego::where('id', $juego->id)->update($request->except('_token', '_method', 'genero_id', 'imagen_original', 'imagen_ruta', 'mime'));
        $juego->generos()->sync($request->genero_id);
        
        $imagenTable = new Imagen();  
        $imagenTable->juego_id = $juego->id;
        $imagenTable->imagen_ruta = $request->imagen_ruta; 
        $imagenTable->imagen_original = $request->imagen_original; 
        $imagenTable->mime = $request->mime; 
        $imagenTable->save(); 
        $juego->imagenes()->save($imagenTable);
        
        return redirect()->route('juegos.show', $juego);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Juego  $juego
     * @return \Illuminate\Http\Response
     */
    
    public function destroy(Juego $juego)
    {
        $juego->delete();
        return redirect()->route('juegos.index')->with('message', '¡Se eliminó el juego con éxito!');
    }

    public function enviarJuego(Request $request, Juego $juego)
    {
        $user = Auth::user();
        $juego->users()->attach($user->id);
        Mail::to($user->email)->send(new TicketJuegoAdquirido($user, $juego));
        return redirect()->back()->with('message', '¡Felicidades, adquiriste el juego! Se te envió un correo con más detalles al respecto.');
    }

    public function uploadMoreFiles(Request $request, Juego $juego)
    {
        if($request->user()->hasRole('Administrador')){
            return view('admin_subir_mas_archivos', compact('juego'));
        }
        else{
            abort(401, 'No estás autorizado para realizar esta acción');
        }
    }
    public function storeMoreFiles(Request $request, Juego $juego)
    {
        $request->validate([
            'imagenes' => 'required',
        ]);
        $imagenes = $request->imagenes;
        $total = 0;

        foreach ($imagenes as $imagen) {
            $mime = $imagen->getClientMimeType();
            $nombre_original = $imagen->getClientOriginalName();
            $ruta = $imagen->store('images', ['disk' => 'my_files']);

            $request->merge([
                'mime' => $mime,
                'imagen_original' => $nombre_original,
                'imagen_ruta' => $ruta,
                'user_id' => Auth::id(),
            ]);

            $imagenTable = new Imagen();  
            $imagenTable->juego_id = $juego->id;
            $imagenTable->imagen_original = $request->imagen_original; 
            $imagenTable->imagen_ruta = $request->imagen_ruta; 
            $imagenTable->mime = $request->mime; 
            $imagenTable->save(); 

            $juego->imagenes()->save($imagenTable);
            $total += 1;
        }

        if($total > 1){
            return redirect()->route('juegos.index')->with('message', '¡Se agregaron las nuevas imagenes con éxito!');
        }
        else{
            return redirect()->route('juegos.index')->with('message', '¡Se agregó la nueva imagen con éxito!');
        }
    }
}
