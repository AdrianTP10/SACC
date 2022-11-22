<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use App\Models\Personal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;


class DepartamentoController extends Controller
{
    public function __construct()
    {
        /* $this->middleware('can:alumno.index')->only('index');
        $this->middleware('can:alumno.create')->only('create','store');
        $this->middleware('can:alumno.edit')->only('edit','update');
        $this->middleware('can:alumno.destroy')->only('destroy'); */
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Departamento/Index',[
            'departamentos' => Departamento::all()->map(function ($departamento) {
                return [
                    'id' => $departamento->id,
                    'nombre' => $departamento->nombre,
                    'jefe' => $departamento->jefe->nombre .' '.$departamento->jefe->apellido,
                ];
            }),
         
            /* 'can' =>[
                'solicitud_index' => Auth::user()->can('solicitud.index'),
                'solicitud_edit' => Auth::user()->can('solicitud.edit'),
                'solicitud_create' => Auth::user()->can('solicitud.create'),
            ] */ 

            //'actividades' => Solicitud::all('descripcion','valor_curricular','estatus_id')->toArray()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Departamento/Create',[
            'personal' => Personal::all('id', 'nombre','apellido'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated=$request->validate([
            'nombre' => 'required|string|max:191',
            'jefe_id' => 'exists:personal,id| required',
        ]);

        Departamento::create($validated);
        return Redirect::route('departamento.index');
    }

 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function edit(Departamento $departamento)
    {
        return Inertia::render('Departamento/Edit',[
            'departamento' => 
            [
                'id' => $departamento->id,
                'nombre' => $departamento->nombre,
                'jefe_id' => $departamento->jefe->id

            ],
            'personal' => Personal::all('id', 'nombre','apellido'),
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Departamento $departamento)
    {
        $validated=$request->validate([
            'nombre' => 'required|string|max:191',
            'jefe_id' => 'exists:personal,id| required',
        ]);
       
        $departamento->update($validated);
        return Redirect::route('departamento.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Departamento $departamento)
    {
        $departamento->delete();
        return Redirect::route('departamento.index');
    }
}
