<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno;
use App\Models\Estatus;
use App\Models\Solicitud;
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
            'solicitudes' => Solicitud::all()->toArray()
           
        ]);

        /*return [
                    'id' => $solicitud->id,
                    'nombre' => $solicitud->nombre,
                    'apellido' => $solicitud->apellido,
                    'no_control' => $solicitud->no_control,
                    'semestre' => $solicitud->semestre,
                    'carrera' => $solicitud->carrera->nombre,
                    'estatus' => $solicitud->estatus->descripcion,
                ];*/
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Alumno/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:191',
            'apellido' => 'required|string|max:191',
            'no_control' => 'required|integer',
            
            
        ]);
        Solicitud::create($validated);
        return Redirect::route('alumnos.index')->with('success', 'Alumno Creado.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function edit(Alumno $alumno)
    {
        //$alumno = Alumno::findOrFail($id);
 
        return Inertia::render('Alumno/Edit',[
            'alumno' => 
            [
                'id' => $alumno->id,
                'nombre' => $alumno->nombre,
                'apellido' => $alumno->apellido,
                'no_control' => $alumno->no_control,
                'semestre' => $alumno->semestre,
                'carrera' => $alumno->carrera->nombre,
                'estatus_id' => $alumno->estatus->id,
            ],
            'lista_estatus' => Estatus::all('id','descripcion')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Solicitud $solicitud)
    {
        
        $validated = $request->validate([
            'nombre' => 'required|string|max:191',
            'apellido' => 'required|string|max:191',
            'no_control' => 'required|string|max:8',
            'estatus_id' => 'required|integer',
        ]);
        //$estatus = Estatus::findOrFail($request->estatus);

        $solicitud->update($validated);
        return Redirect::route('alumnos.index'); 
        //$request->user()->personal()->create($validated);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alumno $alumno)
    {
        $alumno->delete();
        /* return Redirect::route('alumno.index'); */
    }
}
