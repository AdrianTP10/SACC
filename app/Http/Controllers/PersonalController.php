<?php

namespace App\Http\Controllers;

use App\Models\Personal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class PersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return Inertia::render('Personal/Index',[
        'personal' => Personal::all('id','nombre','apellido','rfc')
        /* 'personal' => Personal::all()->get('nombre','apellidio','rfc') */
       /*  'personal' => Personal::all()->toJson() */

       ]);

    }

    public function create()
    {
        return Inertia::render('Personal/Create');
    }
   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validamos los datos
        $validated = $request->validate([
            'nombre' => 'required|string|max:191',
            'apellido' => 'required|string|max:191',
            'rfc' => 'required|string|max:13'
        ]);
        Personal::create($validated);
        return Redirect::route('personal.index');
    }

    public function edit(Personal $personal)
    {
        $dato = Personal::findOrFail($personal->id);
        return Inertia::render('Personal/Edit',[
            'personal' => 
            [
                'id' => $dato->id,
                'nombre' => $dato->nombre,
                'apellido' => $dato->apellido,
                'rfc' => $dato->rfc
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Personal  $personal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Personal $personal)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:191',
            'apellido' => 'required|string|max:191',
            'rfc' =>'required|string|max:13',
        ]);

        $personal->update($validated);
        return Redirect::route('personal.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Personal  $personal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Personal $personal)
    {
        $personal->delete();
    }
}
