<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solicitud;
use App\Models\Actividad;
use App\Models\Alumno;
use App\Models\Departamento;
use App\Models\EstatusSolicitud;
use App\Models\Periodo;
use App\Models\Personal;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class SolicitudController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Solicitud/Index',[
            'solicitudes' => Solicitud::all()->map(function ($solicitud) {
                return [
                    'id' => $solicitud->id,
                    'actividad' => $solicitud->actividad->descripcion,
                    'periodo' => $solicitud->periodo->descripcion,
                    'departamento' => $solicitud->departamento->nombre,
                    'alumno' => $solicitud->alumno->nombre . $solicitud->alumno->appelido,
                    'alumno_ncontrol' => $solicitud->alumno->no_control,
                    'estatus' => $solicitud->estatus->descripcion,
                    'responsable' => $solicitud->responsable->nombre . $solicitud->responsable->apellido,
                ];
            }),
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
        return Inertia::render('Solicitud/Create',[
            'lista_estatus' => EstatusSolicitud::all('id','descripcion'),
            'lista_departamento' => Departamento::all('id','nombre'), 
            'lista_actividades' => Actividad::all('id', 'descripcion'), 
            'lista_periodos' => Periodo::all('id', 'descripcion')
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
       /*  $validated = $request->validate([
            'nombre' => 'required|string|max:191',
            'apellido' => 'required|string|max:191',
            'no_control' => 'required|integer',
            
            
        ]);
        Solicitud::create($validated);
        return Redirect::route('alumnos.index')->with('success', 'Solicitud Creado.'); */
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function edit(Solicitud $solicitud)
    {     
        return Inertia::render('Solicitud/Edit',[
            'solicitud' => 
            [
                'id' => $solicitud->id,
                'actividad_id' => $solicitud->actividad->id,
                'periodo_id' => $solicitud->periodo->id,
                'departamento_id' => $solicitud->departamento->id,
                'no_control' => $solicitud->alumno->no_control,
                'estatus_id' => $solicitud->estatus->id,
                'responsable_id' => $solicitud->responsable->id,
                'calificacion' => $solicitud->calificacion,
                'valor' => $solicitud->valor,
            ],
            'estatus' => EstatusSolicitud::all('id','descripcion'),
            'personal' => Personal::all('id', 'nombre','apellido'),
            'actividades' => Actividad::all('id', 'descripcion'),
            'periodos' => Periodo::all('id', 'descripcion'),
            'departamentos' => Departamento::all('id', 'nombre'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Solicitud $solicitud)
    {
        $alumno = Alumno::findOrFail($request->no_control);
        $validated = $request->validate([
            'actividad_id' => 'required|integer|numeric',
            'periodo_id' => 'required|integer|numeric',
            'departamento_id' => 'required|integer|numeric',
            /* 'no_control', => $alumno->no_control, */
            'estatus_id' => 'required|integer|numeric',
            'responsable_id' => 'required|integer|numeric',
            'calificacion' => 'required|integer|numeric',
            'valor' => 'required|integer|numeric|min:0.5|max:2.0',
        ]);
        //$estatus = Estatus::findOrFail($request->estatus);

        $solicitud->update($validated);
        return Redirect::route('solicitud.index'); 
        //$request->user()->personal()->create($validated);
  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function destroy(Solicitud $solicitud)
    {
        $solicitud->delete();
        return Redirect::route('solicitudes.index');
    }
}
