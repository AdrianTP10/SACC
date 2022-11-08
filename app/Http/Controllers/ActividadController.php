<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ActividadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Actividad/Index',[
            'actividades' => Actividad::all()->map(function ($actividad) {

                return [
                    'id' => $actividad->id,
                    'descripcion' => $actividad->descripcion,
                    'valor_curricular' => $actividad->valor_curricular,
                    'estatus' => $actividad->estatus->descripcion,
                ];
            }),
            //'actividades' => Actividad::all('descripcion','valor_curricular','estatus_id')->toArray()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Actividad/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Actividad  $actividad
     * @return \Illuminate\Http\Response
     */
    public function edit(Actividad $actividad)
    {
        $dato = Actividad::findOrFail($actividad->id);
        return Inertia::render('Actividad/Edit',[
            'actividad' => 
            [
                'id' => $dato->id,
                'nombre' => $dato->descripcion,
                'estatus' => $dato->estatus->descripcion,
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Actividad  $actividad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Actividad $actividad)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Actividad  $actividad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Actividad $actividad)
    {
        //
    }
}
