<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
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
    //Página principal de juegos. Se muestra todo.
    public function index(Request $request)
    {
        if($request->user()){
            $request->user()->authorizeRoles('Administrador', 'Blogger');
            $blogs = Blog::All();
            #$imagenes = Imagen::All();
        }
        else{
            abort(401, 'No estás autorizado para realizar esta acción');
        }
        

        return view('admin_show_all_juegos', compact('juegos', 'imagenes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // Se muestra una página para crear juegos. Es decir, se muestran los campos a llenar.
    // Para guardarlos de verdad, se hace uso del método store
    public function create(Request $request)
    {
        // Para crear un juego, se necesita de un modelo.
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
    // Se llama después de haber llenado los campos a create y presionar el botón de submit.
    // Aquí se guarda el nuevo registro en la base de datos
    public function store(Request $request)
    {
        // Validar datos
        $request->validate([
            'titulo' => 'required|max:100|unique:App\Models\Juego,titulo',
            'fecha_de_publicacion' => 'required',
            'empresa_editora' => 'required|max:255',
            'descripcion' => 'required',
        ]);
        
        #$ruta = $request->imagen->store('imagenes');

        #$file = $request->file('index_image');
        #$file->storeAs('Images', "my-cool-name." . $file->getClientOriginalExtension());

        $mime = $request->imagen->getClientMimeType();
        $nombre_original = $request->imagen->getClientOriginalName();
        #$ruta = $request->imagen->store('toPath', ['disk' => 'my_files']);
        $ruta = $request->imagen->store('images', ['disk' => 'my_files']);
        #$ruta = $request->imagen->store('images');
        
        $request->merge([
            'imagen_original' => $nombre_original,
            'imagen_ruta' => $ruta,
            'mime' => $mime,
            'user_id' => Auth::id(),
        ]);
        
        #$juego = Juego::create($request->all());
        $juego = Juego::create($request->except('_token', '_method', 'genero_id', 'imagen'));
        $juego->generos()->attach($request->genero_id);
        $juego->save();

        $imagenTable = new Imagen();  
        $imagenTable->juego_id = $juego->id;
        $imagenTable->imagen_original = $request->imagen_original; 
        $imagenTable->imagen_ruta = $request->imagen_ruta; 
        $imagenTable->mime = $request->mime; 
        $imagenTable->save(); 

        $juego->imagenes()->save($imagenTable);
        
        return redirect()->route('juegos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Juego  $juego
     * @return \Illuminate\Http\Response
     */
    // Aquí se muestra los datos correspondientes a un juego en específico
    public function show(Juego $juego, Request $request)
    {
        if($request->user()){
            if($request->user()->hasRole('Administrador')){
                $editar = 1;
                return view('admin_show_juego', compact('juego', 'editar'));
            }
            else{
                return view('admin_show_juego', compact('juego'));
            }
        }
        else{
            return view('admin_show_juego', compact('juego'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Juego  $juego
     * @return \Illuminate\Http\Response
     */
    // Aquí se llama a la ventana de creación, pero con un parámetro extra que le indica que en
    // lugar de crear datos, se hará modificación de estos. Es decir, editarlos.
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
    // Así como es el método de store para crear, éste funciona de la misma manera para edit. Es decir, se 
    // encarga de actualizar los datos después de haber modificado los datos a editar.
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
    // Este método se encarga de eliminar a la persona que recibe como parámetro
    public function destroy(Juego $juego)
    {
        $juego->delete();
        return redirect()->route('juegos.index');
    }
}
