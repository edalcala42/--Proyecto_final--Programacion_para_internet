<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use App\Models\Juego;
use App\Models\Genero;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;

class GeneroController extends Controller
{
    public function index(Request $request)
    {
        if($request->user()){
            $request->user()->authorizeRoles('Administrador');
            $generos = Genero::All();
        }
        else{
            abort(401, 'No estás autorizado para realizar esta acción');
        }
        return view('admin_show_all_generos', compact('generos'));
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
            return view('admin_crear_genero');
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
        $request->validate([
            'nombre_genero' => 'required|max:100|unique:App\Models\Genero,nombre_genero',
            'descripcion_genero' => 'required',
        ]);
        
        $genero = new Genero();
        $genero->nombre_genero = $request->nombre_genero;
        $genero->descripcion_genero = $request->descripcion_genero;
        $genero->save(); 
        
        return redirect()->route('generos.index')->with('message', '¡Se guardó el genero con éxito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Genero $genero
     * @return \Illuminate\Http\Response
     */
    
    public function show(Genero $genero, Request $request)
    {
        if($request->user()){
            $request->user()->authorizeRoles('Administrador');
            return view('admin_show_genero', compact('genero'));
        }
        else{
            abort(401, 'No estás autorizado para realizar esta acción');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Genero  $genero
     * @return \Illuminate\Http\Response
     */
    
    public function edit(Genero $genero, Request $request)
    {
        if($request->user()){
            $request->user()->authorizeRoles('Administrador');
            return view('admin_editar_genero', compact('genero'));
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
    
    public function update(Request $request, Genero $genero)
    {
        $request->validate([
            'nombre_genero' => [
                'required', 
                Rule::unique('generos')->ignore($genero->id),
            ],
        ]);

        $request->merge([
            'descripcion_genero' => $request->descripcion_genero ?? $genero->descripcion_genero,
        ]);

        Genero::where('id', $genero->id)->update($request->except('_token', '_method', 'website'));
        
        return redirect()->route('generos.show', $genero);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Genero  $genero
     * @return \Illuminate\Http\Response
     */
    
    public function destroy(Genero $genero)
    {
        $genero->delete();
        return redirect()->route('generos.index')->with('message', '¡Se eliminó el genero con éxito!');
    }
}
