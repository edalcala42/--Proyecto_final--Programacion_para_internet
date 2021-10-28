<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JuegoController extends Controller
{
    public function __construct()
    {
        #$this->middleware('auth')->except('index', 'show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Página principal de juegos. Se muestra todo.
    public function index()
    {
        return view('index_juegos');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // Se muestra una página para crear juegos. Es decir, se muestran los campos a llenar.
    // Para guardarlos de verdad, se hace uso del método store
    public function create()
    {
        return view('create_juego');
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
        return view('index_juegos');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    // Aquí se muestra los datos correspondientes a un juego en específico
    public function show(Persona $persona)
    {
        return view('show_juego');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    // Aquí se llama a la ventana de creación, pero con un parámetro extra que le indica que en
    // lugar de crear datos, se hará modificación de estos. Es decir, editarlos.
    public function edit(Persona $persona)
    {
        return view('create_juego');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    // Así como es el método de store para crear, éste funciona de la misma manera para edit. Es decir, se 
    // encarga de actualizar los datos después de haber modificado los datos a editar.
    public function update(Request $request, Persona $persona)
    {
        return view('show_juego');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    // Este método se encarga de eliminar a la persona que recibe como parámetro
    public function destroy(Persona $persona)
    {
        return view('index_juegos');
        #$persona->delete();
        #return redirect()->route('index');
    }

    // Este método, a diferencia del resto, no se utiliza como página de interacción con el usuario, sino que
    // funciona como indicador de la relación que el modelo correspondiente a este controlador 
    // tiene con otra clase
    public function user(){
        #return $this->belongsTo(User::class);
    }
}
