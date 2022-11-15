<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use App\Models\Estatus;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Redirect;

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
                    'valor_curricular' => $actividad->valor,
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
        return Inertia::render('Actividad/Create',[
            'estatus' => Estatus::all('id','descripcion'),
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
        $validated = $request->validate([
            'descripcion' => 'required|string|max:191',
            'estatus_id' => 'exists:estatus,id| required',
            'valor' => Rule::in([0.5,1.0, 1.5,2.0]),
        ]);
        Actividad::create($validated);
        return Redirect::route('actividad.index');
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
                'descripcion' => $dato->descripcion,
                'estatus_id' => $dato->estatus_id,
                'valor' => $dato->valor
            ],
            'estatus' => Estatus::all('id','descripcion'),
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
        $validated = $request->validate([
            'descripcion' => 'required|string|max:191',
            'estatus_id' => 'exists:estatus,id| required',
            'valor' => Rule::in([0.5,1.0, 1.5,2.0]),
        ]);

        $actividad->update($validated);
        return Redirect::route('actividad.index'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Actividad  $actividad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Actividad $actividad)
    {
        $actividad->delete();
    }
}
