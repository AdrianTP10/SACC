<?php

namespace App\Http\Controllers;
use App\Models\Alumno;
use App\Models\Carrera;
use App\Models\Estatus;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;


class AlumnoController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Alumno/Index',[
            'alumnos' => Alumno::all()->map(function ($alumno) {
    
                return [
                    'id' => $alumno->id,
                    'nombre' => $alumno->nombre,
                    'apellido' => $alumno->apellido,
                    'no_control' => $alumno->no_control,
                    'semestre' => $alumno->semestre,
                    'carrera' => $alumno->carrera->nombre,
                    'estatus' => $alumno->estatus->descripcion,
                ];
            }),
            //'actividades' => Alumno::all('descripcion','valor_curricular','estatus_id')->toArray()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Alumno/Create', [
            'lista_estatus' => Estatus::all('id','descripcion'),
            'lista_carreras' => Carrera::all('id','nombre'),
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
            'nombre' => 'required|string|max:191',
            'apellido' => 'required|string|max:191',
            'no_control' => 'required|integer|numeric|max_digits:8',
            'semestre' => 'required|integer|numeric|min:1|max:12',
            'carrera_id' => 'required|integer|numeric',
            'estatus_id' => 'required|integer|numeric',
        ]);
        Alumno::create($validated);
        //return Redirect::route('alumnos.index')->with('success', 'Alumno Creado.');
        return Redirect::route('alumnos.index');
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
                'carrera_id' => $alumno->carrera->id,
                'estatus_id' => $alumno->estatus->id,
            ],
            'lista_estatus' => Estatus::all('id','descripcion'),
            'lista_carreras' => Carrera::all('id','nombre'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alumno $alumno)
    {
        
        $validated = $request->validate([
            'nombre' => 'required|string|max:191',
            'apellido' => 'required|string|max:191',
            'no_control' => 'required|integer|numeric|max_digits:8',
            'semestre' => 'required|integer|numeric|min:1|max:12',
            'carrera_id' => 'required|integer|numeric',
            'estatus_id' => 'required|integer|numeric',
        ]);
        //$estatus = Estatus::findOrFail($request->estatus);

        $alumno->update($validated);
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
