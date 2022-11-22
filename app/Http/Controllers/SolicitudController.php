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
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Redirect;

class SolicitudController extends Controller
{
    public function __construct()
    {
        /* $this->middleware('can:solicitud.index')->only('index');
        $this->middleware('can:solicitud.create')->only('create','store');
        $this->middleware('can:solicitud.edit')->only('edit','update');
        $this->middleware('can:solicitud.destroy')->only('destroy'); */
    }

   
    
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
                    'valor' => $solicitud->valor,
                ];
            }),
           
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
    public function indexDepartamento(){
        if(Auth::user()->hasRole('departamento')){
            return Inertia::render('Solicitud/Index',[
                'solicitudes' => Solicitud::where('departamento_id', Auth::user()->departamento->id)->get()->map(function ($solicitud) {
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
    }

    public function indexAlumno(){
        if(Auth::user()->hasRole('alumno')){
            //Muestra las solicitudes de un alumno
            return Inertia::render('Solicitud/MisSolicitudes',[
                'solicitudes' => Solicitud::where('alumno_id', Auth::user()->id)->get()->map(function ($solicitud) {
                    return [
                        'id' => $solicitud->id,
                        'actividad' => $solicitud->actividad->descripcion,
                        'alumno' => $solicitud->alumno->nombre .' '.$solicitud->alumno->apellido,
                        'alumno_ncontrol' => $solicitud->alumno->no_control,
                        'periodo' => $solicitud->periodo->descripcion,
                        'departamento' => $solicitud->departamento->nombre,
                        'valor' => $solicitud->valor,
                        'estatus' => $solicitud->estatus->descripcion,
                    ];
                }),
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
    }
    
    public function misCreditos(){
        if(Auth::user()->hasRole('alumno')){
            //Muestra las solicitudes de un alumno
            return Inertia::render('Solicitud/MisCreditos',[
                'solicitudes' => Solicitud::where('alumno_id', Auth::user()->id)->where('estatus_id', '=', 1)->get()->map(function ($solicitud) {
                    return [
                        'id' => $solicitud->id,
                        'actividad' => $solicitud->actividad->descripcion,
                        'alumno' => $solicitud->alumno->nombre .' '.$solicitud->alumno->apellido,
                        'alumno_ncontrol' => $solicitud->alumno->no_control,
                        'periodo' => $solicitud->periodo->descripcion,
                        'departamento' => $solicitud->departamento->nombre,
                        'calificacion' => $solicitud->calificacion,
                        'valor' => $solicitud->valor,
                        'estatus' => $solicitud->estatus->descripcion,
                    ];
                }),
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
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        if(Auth::user()->hasRole('admin')){
            return Inertia::render('Solicitud/AdminCreate',[
                'estatus' => EstatusSolicitud::all('id','descripcion'),
                'personal' => Personal::all('id', 'nombre','apellido'),
                'periodos' => Periodo::all('id', 'descripcion'),
                'departamentos' => Departamento::all('id', 'nombre'),
                'actividades' => Actividad::all()->map(function ($actividad){
                   return[
                    'id' => $actividad->id,
                    'descripcion' => $actividad->descripcion,
                    'departamento' => $actividad->departamento->nombre,
                    'valor' => $actividad->valor,
                   ];
                }),
    
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
        return Inertia::render('Solicitud/Create',[
            'estatus' => EstatusSolicitud::all('id','descripcion'),
            'periodos' => Periodo::all('id', 'descripcion'),
            'actividades' => Actividad::all()->map(function ($actividad){
               return[
                'id' => $actividad->id,
                'descripcion' => $actividad->descripcion,
                'departamento' => $actividad->departamento->nombre,
                'valor' => $actividad->valor,
               ];
            }),

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
        if(Auth::user()->hasRole('admin')){
            $request->validate([
                'actividad_id' => 'exists:actividades,id| required',
                'periodo_id' => 'exists:periodos,id| required',
                'departamento_id' => 'exists:departamentos,id| required',
                'no_control' => 'exists:alumnos,no_control| required', 
                'estatus_id' => 'exists:estatus_solicitud,id| required',
                'responsable_id' => 'exists:personal,id| required',
                'calificacion' => 'required|integer|numeric',
                'valor' => Rule::in([0.5,1.0, 1.5,2.0]),
            ]);
            $alumno = Alumno::where('no_control', '=',  $request->no_control)->firstOrFail();  
    
            $solicitud = new Solicitud;
            $solicitud->actividad_id = $request->actividad_id;
            $solicitud->periodo_id = $request->periodo_id;
            $solicitud->departamento_id = $request->departamento_id;
            $solicitud->alumno_id = $alumno->id;
            $solicitud->estatus_id = $request->estatus_id;
            $solicitud->responsable_id = $request->responsable_id;
            $solicitud->calificacion = $request->calificacion;
            $solicitud->valor = $request->valor;
            $solicitud->save();
    
            return Redirect::route('solicitud.index')->with('success', 'Solicitud Creada.');

        }


        //Crear Solicitud Rol => Alumno
        $request->validate([
            'actividad_id' => 'exists:actividades,id| required',
            'periodo_id' => 'exists:periodos,id| required',
        ]);
        $usuario = Auth::user();
        $actividad = Actividad::findOrFail($request->actividad_id);

        $solicitud = new Solicitud;
        $solicitud->actividad_id = $request->actividad_id;
        $solicitud->periodo_id = $request->periodo_id;
        $solicitud->alumno_id = $usuario->perfil_alumno->id;
        $solicitud->departamento_id = $actividad->departamento_id;
        $solicitud->calificacion = 0;
        $solicitud->estatus_id = 1;
        $solicitud->valor = $actividad->valor;
        $solicitud->save();

        return Redirect::route('alumno.solicitudes')->with('success', 'Solicitud Creada.');
        
       
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
            'actividad_id' => 'exists:actividades,id | required',
            'periodo_id' => 'exists:periodos,id | required',
            'departamento_id' => 'exists:departamentos,id | required',
            /* 'no_control', => $alumno->no_control, */
            'estatus_id' => 'exists:estatus_solicitud,id | required',
            'responsable_id' => 'exists:personal,id | required',
            'calificacion' => 'required|integer|numeric',
            'valor' => 'required|integer|numeric|min:0.5|max:2.0',
        ]);


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
