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
            return Inertia::render('Actividades/Departamento/Index',[
                'actividades' => Auth::user()->perfil_personal->departamento->actividades->map(function ($actividad) {
                    return [
                        'id' => $actividad->id,
                        'descripcion' => $actividad->descripcion,
                        'departamento' => $actividad->departamento->nombre,
                        'valor_curricular' => $actividad->valor,
                        'estatus' => $actividad->estatus->descripcion,
                    ];
                }),
                'departamento' => Auth::user()->perfil_personal->departamento->nombre,
                
                'hasRole' =>[
                    'admin' => Auth::user()->hasRole('admin'),
                    'departamento' => Auth::user()->hasRole('departamento'),
                    'alumno' => Auth::user()->hasRole('alumno'),
                    'escolares' => Auth::user()->hasRole('escolares'),
                ],
           ]);
        }

        return Inertia::render('Actividades/Index',[
            'actividades' => Actividad::all()->map(function ($actividad) {
                return [
                    'id' => $actividad->id,
                    'descripcion' => $actividad->descripcion,
                    'departamento' => $actividad->departamento->nombre,
                    'valor_curricular' => $actividad->valor,
                    'estatus' => $actividad->estatus->descripcion,
                ];
            }),
            'hasRole' =>[
                'admin' => Auth::user()->hasRole('admin'),
                'departamento' => Auth::user()->hasRole('departamento'),
                'alumno' => Auth::user()->hasRole('alumno'),
                'escolares' => Auth::user()->hasRole('escolares'),
                'escolares' => Auth::user()->hasRole('escolares'),
            ],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->hasRole('departamento')){
            return Inertia::render('Actividades/Departamento/Create',[
                'departamento' => Auth::user()->perfil_personal->departamento->nombre,
                'estatus' => Estatus::all('id','descripcion'),
                'hasRole' =>[
                    'admin' => Auth::user()->hasRole('admin'),
                    'departamento' => Auth::user()->hasRole('departamento'),
                    'alumno' => Auth::user()->hasRole('alumno'),
                    'escolares' => Auth::user()->hasRole('escolares'),
                ],
           ]);
        }


        return Inertia::render('Actividad/Create',[
            'estatus' => Estatus::all('id','descripcion'),
            'departamentos' => Departamento::all('id','nombre'),
            'hasRole' =>[
                'admin' => Auth::user()->hasRole('admin'),
                'departamento' => Auth::user()->hasRole('departamento'),
                'alumno' => Auth::user()->hasRole('alumno'),
                'escolares' => Auth::user()->hasRole('escolares'),
            ],
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
        if(Auth::user()->hasRole('departamento')){
            $validated = $request->validate([
                'descripcion' => 'required|string|max:191',
                'estatus_id' => 'exists:estatus,id| required',
                'valor' => Rule::in([0.5,1.0, 1.5,2.0]),
            ]);
            $actividad = new Actividad;
            $actividad->descripcion = $request->descripcion;
            $actividad->estatus_id = $request->estatus_id;
            $actividad->valor = $request->valor;
            $actividad->departamento_id = Auth::user()->perfil_personal->departamento->id;
            $actividad->save();
            return Redirect::route('actividad.index');
        }
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
        if(Auth::user()->hasRole('departamento')){
            return Inertia::render('Actividades/Departamento/Edit',[
                'actividad' => 
                [
                    'id' => $dato->id,
                    'descripcion' => $dato->descripcion,
                    'estatus_id' => $dato->estatus_id,
                    'valor' => $dato->valor
                ],
                'estatus' => Estatus::all('id','descripcion'),
                'hasRole' =>[
                    'admin' => Auth::user()->hasRole('admin'),
                    'departamento' => Auth::user()->hasRole('departamento'),
                    'alumno' => Auth::user()->hasRole('alumno'),
                    'escolares' => Auth::user()->hasRole('escolares'),
                ],
            ]);
        }
        
        return Inertia::render('Actividades/Edit',[
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
            'hasRole' =>[
                'admin' => Auth::user()->hasRole('admin'),
                'departamento' => Auth::user()->hasRole('departamento'),
                'alumno' => Auth::user()->hasRole('alumno'),
                'escolares' => Auth::user()->hasRole('escolares'),
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
        if(Auth::user()->hasRole('departamento')){
            $validated = $request->validate([
                'descripcion' => 'required|string|max:191',
                'estatus_id' => 'exists:estatus,id| required',
                'valor' => Rule::in([0.5,1.0, 1.5,2.0]),
            ]);
            $actividad->update($validated);
            return Redirect::route('actividad.index');
        }
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
