<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solicitud;
use App\Models\Actividad;
use App\Models\Departamento;
use App\Models\EstatusSolicitud;
use App\Models\Periodo;
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
       
        var_dump($solicitud);
        return Inertia::render('Solicitud/Edit',[
            'solicitud' => 
            [
                'id' => $solicitud->id,
                'actividad' => $solicitud->actividad->descripcion,
                'periodo' => $solicitud->periodo->descripcion,
                'departamento' => $solicitud->departamento->nombre,
                'alumno' => $solicitud->alumno->nombre . $solicitud->alumno->appelido,
                'alumno_ncontrol' => $solicitud->alumno->no_control,
                'estatus' => $solicitud->estatus->descripcion,
                'responsable' => $solicitud->responsable->nombre . $solicitud->responsable->apellido,
            ],
            'lista_estatus' => EstatusSolicitud::all('id','descripcion')
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
        
        /* $validated = $request->validate([
            'nombre' => 'required|string|max:191',
            'apellido' => 'required|string|max:191',
            'no_control' => 'required|string|max:8',
            'estatus_id' => 'required|integer',
        ]);
     

        $solicitud->update($validated);
        return Redirect::route('alumnos.index');  */
  
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
