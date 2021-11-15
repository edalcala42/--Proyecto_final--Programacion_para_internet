<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use App\Models\Juego;
use App\Models\Imagen;
use App\Models\Comentario;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
    
    public function index(Request $request)
    {
        if($request->user()){
            $request->user()->authorizeRoles('Blogger');
            $blogs = Blog::All();
        }
        else{
            abort(401, 'No estás autorizado para realizar esta acción');
        }
        return view('blogger_show_all_blogs', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create(Request $request)
    {
        // Para crear un juego, se necesita de un modelo.
        if($request->user()){
            $request->user()->authorizeRoles('Blogger');
            $juegos = Juego::All();
            return view('blogger_crear_blog', compact('juegos'));
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
            'titulo' => 'required|max:100|unique:App\Models\Blog,titulo',
            'juego_id' => 'required',
            'contenido' => 'required',
        ]);
        
        $request->merge([
            'user_id' => Auth::id(),
        ]);
        
        $blog = new Blog();
        $blog->user_id = $request->user_id;
        $blog->juego_id = $request->juego_id;
        $blog->titulo = $request->titulo;
        $blog->contenido = $request->contenido;
        $blog->save(); 
        
        return redirect()->route('blogs.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    
    public function show(Blog $blog, Request $request)
    {
        $comentarios = Comentario::where('blog_id', $blog->id)->get();
        if($request->user()){
            if($request->user()->hasRole('Blogger')){
                $sesion_blogger = 1;
                return view('blogger_show_blog', compact('blog', 'sesion_blogger', 'comentarios'));
            }
            else{
                $sesion_regular_user = 1;
                return view('blogger_show_blog', compact('blog', 'sesion_regular_user', 'comentarios'));
            }
        }
        else{
            $sesion_invitado = 1;
            return view('blogger_show_blog', compact('blog', 'sesion_invitado', 'comentarios'));
        }
    }

    public function storeComentario2(Request $request, Blog $blog){
        $request->merge([
            'user_id' => Auth::id(),
            'juego_id' => $blog->juego_id,
            'blog_id'=> $blog->id

        ]);
        $comentarioTable = new Comentario();
        $comentarioTable->user_id = $request->user_id;
        $comentarioTable->juego_id = $blog->juego_id;
        $comentarioTable->blog_id = $blog->id;
        $comentarioTable->comentario = $request->comentario;
        $comentarioTable->save();

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    // Aquí se llama a la ventana de creación, pero con un parámetro extra que le indica que en
    // lugar de crear datos, se hará modificación de estos. Es decir, editarlos.
    public function edit(Blog $blog, Request $request)
    {
        if($request->user()){
            $request->user()->authorizeRoles('Blogger');
            $juegos = Juego::All();
            return view('blogger_editar_blog', compact('blog', 'juegos'));
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
    public function update(Request $request, Blog $blog)
    {
        // Validar datos
        $request->validate([
            'titulo' => [
                'required', 
                Rule::unique('blogs')->ignore($blog),
            ],
            'contenido' => 'required',
        ]);

        $request->merge([
            'user_id' => $blog->user_id,
            'juego_id' => $request->juego_id ?? $blog->juego_id,
            'contenido' => $request->contenido ?? $blog->contenido,
        ]);

        Blog::where('id', $blog->id)->update($request->except('_token', '_method', 'website'));
        
        return redirect()->route('blogs.show', $blog);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    // Este método se encarga de eliminar a la persona que recibe como parámetro
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('blogs.index');
    }
}
