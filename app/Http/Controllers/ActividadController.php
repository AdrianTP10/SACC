<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Actividad;
use App\Models\Estatus;
use App\Models\Departamento;
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
        //Muestra la Lista de Actividades de un Departamento
        if(Auth::user()->hasRole('departamento')){
            return Inertia::render('Actividad/Index',[
                'actividades' => Auth::user()->perfil_personal->departamento->actividades->map(function ($actividad) {
                    return [
                        'id' => $actividad->id,
                        'descripcion' => $actividad->descripcion,
                        'departamento' => $actividad->departamento->nombre,
                        'valor_curricular' => $actividad->valor,
                        'estatus' => $actividad->estatus->descripcion,
                    ];
                }),
        
                'can' =>[
                    'personal_index' => Auth::user()->hasPermissionTo('personal.index'),
                    'solicitud_index' => Auth::user()->hasPermissionTo('solicitud.index'),
                    'actividad_index' => Auth::user()->hasPermissionTo('actividad.index'),
                    'actividad_edit' => Auth::user()->hasPermissionTo('actividad.edit'),
                    'actividad_create' => Auth::user()->hasPermissionTo('actividad.create'),
                    'alumno_index' => Auth::user()->hasPermissionTo('alumno.index'),
                    'periodo_index' => Auth::user()->hasPermissionTo('periodo.index'),
                    'departamento_index' => Auth::user()->hasPermissionTo('departamento.index'),
                ]
           ]);
        }

        return Inertia::render('Actividad/Index',[
            'actividades' => Actividad::all()->map(function ($actividad) {
                return [
                    'id' => $actividad->id,
                    'descripcion' => $actividad->descripcion,
                    'departamento' => $actividad->departamento->nombre,
                    'valor_curricular' => $actividad->valor,
                    'estatus' => $actividad->estatus->descripcion,
                ];
            }),
            'can' =>[
                'personal_index' => Auth::user()->hasPermissionTo('personal.index'),
                'solicitud_index' => Auth::user()->hasPermissionTo('solicitud.index'),
                'actividad_index' => Auth::user()->hasPermissionTo('actividad.index'),
                'actividad_edit' => Auth::user()->hasPermissionTo('actividad.edit'),
                'actividad_create' => Auth::user()->hasPermissionTo('actividad.create'),
                'alumno_index' => Auth::user()->hasPermissionTo('alumno.index'),
                'periodo_index' => Auth::user()->hasPermissionTo('periodo.index'),
                'departamento_index' => Auth::user()->hasPermissionTo('departamento.index'),
            ]
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
            'departamentos' => Departamento::all('id','nombre'),
            'can' =>[
                'personal_index' => Auth::user()->hasPermissionTo('personal.index'),
                'solicitud_index' => Auth::user()->hasPermissionTo('solicitud.index'),
                'solicitud_show' => Auth::user()->hasPermissionTo('solicitud.show'),
                'actividad_index' => Auth::user()->hasPermissionTo('actividad.index'),
                'alumno_index' => Auth::user()->hasPermissionTo('alumno.index'),
                'periodo_index' => Auth::user()->hasPermissionTo('periodo.index'),
                'departamento_index' => Auth::user()->hasPermissionTo('departamento.index'),
            ]
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
            'departamento_id' => 'exists:departamentos,id| required',
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
                'departamento_id' => $dato->departamento->id,
                'valor' => $dato->valor
            ],
            'estatus' => Estatus::all('id','descripcion'),
            'departamentos' => Departamento::all('id','nombre'),
            'can' =>[
                'personal_index' => Auth::user()->hasPermissionTo('personal.index'),
                'solicitud_index' => Auth::user()->hasPermissionTo('solicitud.index'),
                'solicitud_show' => Auth::user()->hasPermissionTo('solicitud.show'),
                'actividad_index' => Auth::user()->hasPermissionTo('actividad.index'),
                'alumno_index' => Auth::user()->hasPermissionTo('alumno.index'),
                'periodo_index' => Auth::user()->hasPermissionTo('periodo.index'),
                'departamento_index' => Auth::user()->hasPermissionTo('departamento.index'),
            ]
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
            'departamento_id' => 'exists:departamentos,id| required',
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
