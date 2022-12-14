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
use Illuminate\Support\Facades\DB;
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
        return Inertia::render('Solicitudes/Index',[
            'solicitudes' => Solicitud::where('estatus_id',2)->get()->map(function ($solicitud) {
                return [
                    'id' => $solicitud->id,
                    'actividad' => $solicitud->actividad->descripcion,
                    'periodo' => $solicitud->periodo->descripcion,
                    'departamento' => $solicitud->actividad->departamento->nombre,
                    'alumno' => $solicitud->alumno->nombre . $solicitud->alumno->appelido,
                    'alumno_ncontrol' => $solicitud->alumno->no_control,
                    'estatus' => $solicitud->estatus->descripcion,
                    'responsable' => $solicitud->responsable->nombre .' '. $solicitud->responsable->apellido,
                    'valor' => $solicitud->valor,
                ];
            }),
            'hasRole' =>[
                'admin' => Auth::user()->hasRole('admin'),
                'departamento' => Auth::user()->hasRole('departamento'),
                'alumno' => Auth::user()->hasRole('alumno'),
                'escolares' => Auth::user()->hasRole('escolares'),
            ],
        ]);
    }
    public function indexDepartamento(){
        if(Auth::user()->hasRole('departamento')){

            $solicitudes = Auth::user()->perfil_personal->departamento->solicitudes->where('estatus_id',1);
            $prueba = DB::table('solicitudes')
                    ->join('actividades', 'actividades.id', '=', 'solicitudes.actividad_id')
                    ->select('solicitudes.*')->where('actividades.departamento_id',1)
                    ->get();
            var_dump($prueba);
            return Inertia::render('Solicitudes/Departamento/Index',[

                //var_dump($solicitudes),
                'solicitudes' => $solicitudes->map(function ($solicitud) {
                    return [
                        'id' => $solicitud->id,
                        /* 'actividad' => $solicitud->actividad->descripcion,
                        'periodo' => $solicitud->periodo->descripcion,
                        'alumno' => $solicitud->alumno->nombre.' '.$solicitud->alumno->apellido,
                        'alumno_ncontrol' => $solicitud->alumno->no_control,
                        'valor' => $solicitud->valor,
                        'estatus' => $solicitud->estatus->descripcion, */
                    ];
                }),
                //'solicitudes' => Auth::user()->perfil_personal->departamento->solicitudes->where('estatus_id',1)->get()->map(function ($solicitud) {
                    /* 'solicitudes' => DB::table('solicitudes')
                    ->join('actividades', 'solicitudes.actividad_id', '=', 'actividades.id')
                    ->select('solicitudes.*')->where('actividades.departamento_id',Auth::user()->perfil_personal->departamento->id)
                    ->get(),->map(function ($solicitud) { */
                    
                        /* 'solicitudes'  => DB::table('solicitudes')
                        ->join('actividades', function ($join) {
                            $join->on('actividades.id', '=', 'solicitudes.actividad_id')
                                ->where('actividades.departamento_id', '=', 1);
                        })
                        ->get(), *//* ->map(function ($solicitud) {  */
                /* 'solicitudes' => Auth::user()->perfil_personal->departamento->solicitudes_nuevas->get()->map(function ($solicitud) {
                    return [
                        'id' => $solicitud->id,
                        'actividad' => $solicitud->actividad->descripcion,
                        'periodo' => $solicitud->periodo->descripcion,
                        'alumno' => $solicitud->alumno->nombre.' '.$solicitud->alumno->apellido,
                        'alumno_ncontrol' => $solicitud->alumno->no_control,
                        'valor' => $solicitud->valor,
                        'estatus' => $solicitud->estatus->descripcion,
                    ];
                }), */
                'departamento' => Auth::user()->perfil_personal->departamento->nombre,
                'hasRole' =>[
                    'admin' => Auth::user()->hasRole('admin'),
                    'departamento' => Auth::user()->hasRole('departamento'),
                    'alumno' => Auth::user()->hasRole('alumno'),
                    'escolares' => Auth::user()->hasRole('escolares'),
                ],
            ]);
        }
    }

    public function indexAlumno(){
        if(Auth::user()->hasRole('alumno')){
            //Muestra las solicitudes de un alumno
            return Inertia::render('Solicitudes/Alumno/MisSolicitudes',[
                //'solicitudes' => Solicitud::where('alumno_id', Auth::user()->id)->get()->map(function ($solicitud) {
                'solicitudes' => Auth::user()->perfil_alumno->solicitudes->map(function ($solicitud) {
                    return [
                        'id' => $solicitud->id,
                        'actividad' => $solicitud->actividad->descripcion,
                        'periodo' => $solicitud->periodo->descripcion,
                        'departamento' => $solicitud->actividad->departamento->nombre,
                        'valor' => $solicitud->valor,
                        'estatus' => $solicitud->estatus->descripcion, 
                    ];
                }),
                'hasRole' =>[
                    'admin' => Auth::user()->hasRole('admin'),
                    'departamento' => Auth::user()->hasRole('departamento'),
                    'alumno' => Auth::user()->hasRole('alumno'),
                    'escolares' => Auth::user()->hasRole('escolares'),
                ],
            ]);
        }
    }
    
    public function misCreditos(){
        if(Auth::user()->hasRole('alumno')){
            //Muestra las solicitudes de un alumno
            return Inertia::render('Solicitudes/Alumno/MisCreditos',[
                'solicitudes' =>  Auth::user()->perfil_alumno->solicitudes->where('estatus_id', '=', 1)->map(function ($solicitud) {
                    return [
                        'id' => $solicitud->id,
                        'actividad' => $solicitud->actividad->descripcion,
                        'alumno' => $solicitud->alumno->nombre .' '.$solicitud->alumno->apellido,
                        'alumno_ncontrol' => $solicitud->alumno->no_control,
                        'periodo' => $solicitud->periodo->descripcion,
                        'departamento' => $solicitud->actividad->departamento->nombre,
                        'calificacion' => $solicitud->calificacion,
                        'valor' => $solicitud->valor,
                        'estatus' => $solicitud->estatus->descripcion,
                    ];
                }),
                'hasRole' =>[
                    'admin' => Auth::user()->hasRole('admin'),
                    'departamento' => Auth::user()->hasRole('departamento'),
                    'alumno' => Auth::user()->hasRole('alumno'),
                    'escolares' => Auth::user()->hasRole('escolares'),
                ],
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
            return Inertia::render('Solicitudes/AdminCreate',[
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
                'hasRole' =>[
                    'admin' => Auth::user()->hasRole('admin'),
                    'departamento' => Auth::user()->hasRole('departamento'),
                    'alumno' => Auth::user()->hasRole('alumno'),
                    'escolares' => Auth::user()->hasRole('escolares'),
                ],    
            ]);
        }

        if(Auth::user()->hasRole('departamento')){
            return Inertia::render('Solicitudes/Departamento/Create',[
                'responsable' =>Auth::user()->perfil_personal->nombre.' '.Auth::user()->perfil_personal->apellido,
                'periodos' => Periodo::all('id', 'descripcion'),
                
                'estatus' => EstatusSolicitud::whereNotIn('descripcion', ['Acreditado'])->select('id','descripcion')->get(),
                'actividades' => Auth::user()->perfil_personal->departamento->actividades,
                'periodos' => Periodo::all('id', 'descripcion'),
                'hasRole' =>[
                    'admin' => Auth::user()->hasRole('admin'),
                    'departamento' => Auth::user()->hasRole('departamento'),
                    'alumno' => Auth::user()->hasRole('alumno'),
                    'escolares' => Auth::user()->hasRole('escolares'),
                ],
            ]);
        }


        //Crear Solicitud Rol -> Alumno
        return Inertia::render('Solicitudes/Alumno/Create',[
            'periodos' => Periodo::all('id', 'descripcion'),
            'actividades' => Actividad::all()->map(function ($actividad){
               return[
                'id' => $actividad->id,
                'descripcion' => $actividad->descripcion,
                'departamento' => $actividad->departamento->nombre,
                'valor' => $actividad->valor,
               ];
            }),
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
            $request->validate([
                'actividad_id' => 'exists:actividades,id| required',
                'periodo_id' => 'exists:periodos,id| required',
                'no_control' => 'exists:alumnos,no_control| required', 
                'estatus_id' => 'exists:estatus_solicitud,id| required',
                'calificacion' => 'required|integer|numeric|min:0|max:100',
                'valor' => Rule::in([0.5,1.0,2.0]),
            ]);
            $alumno = Alumno::where('no_control', '=',  $request->no_control)->firstOrFail();  
    
            $solicitud = new Solicitud;
            $solicitud->actividad_id = $request->actividad_id;
            $solicitud->periodo_id = $request->periodo_id;
            $solicitud->alumno_id = $alumno->id;
            $solicitud->estatus_id = $request->estatus_id;
            $solicitud->calificacion = $request->calificacion;
            $solicitud->valor = $request->valor;

            $solicitud->responsable_id = Auth::user()->perfil_personal->id;
            $solicitud->save();
    
            return Redirect::route('departamento.solicitudes')->with('success', 'Solicitud Creada.');
        }
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
        $alumno = Auth::user()->perfil_alumno;
        $actividad = Actividad::findOrFail($request->actividad_id);

        $solicitud = new Solicitud;
        $solicitud->actividad_id = $request->actividad_id;
        $solicitud->periodo_id = $request->periodo_id;
        $solicitud->alumno_id = $alumno->id;
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
        //Editar Solicitud Rol => Departamento
        if(Auth::user()->hasRole('departamento')){
            return Inertia::render('Solicitudes/Departamento/Edit',[
                'solicitud' => 
                [
                    'id' => $solicitud->id,
                    'actividad_id' => $solicitud->actividad->id,
                    'periodo_id' => $solicitud->periodo->id,
                    'departamento_id' => $solicitud->actividad->departamento->id,
                    'no_control' => $solicitud->alumno->no_control,
                    'estatus_id' => $solicitud->estatus->id,
                    'responsable' => Auth::user()->perfil_personal->nombre .' '.Auth::user()->perfil_personal->apellido ,
                    'valor' => $solicitud->valor,
                ],
                'estatus' => EstatusSolicitud::whereNotIn('descripcion', ['Acreditado'])->select('id','descripcion')->get(),
                'actividades' => Auth::user()->perfil_personal->departamento->actividades,
                'periodos' => Periodo::all('id', 'descripcion'),
                'hasRole' =>[
                    'admin' => Auth::user()->hasRole('admin'),
                    'departamento' => Auth::user()->hasRole('departamento'),
                    'alumno' => Auth::user()->hasRole('alumno'),
                    'escolares' => Auth::user()->hasRole('escolares'),
                ],
               
            ]);
        }


        return Inertia::render('Solicitudes/Edit',[
            'solicitud' => 
            [
                'id' => $solicitud->id,
                'actividad_id' => $solicitud->actividad->id,
                'periodo_id' => $solicitud->periodo->id,
                'departamento_id' => $solicitud->actividad->departamento->id,
                //'no_control' => $solicitud->alumno->no_control,
                'estatus_id' => $solicitud->estatus->id,
                'responsable' => Auth::user()->perfil_personal->nombre .' '.Auth::user()->perfil_personal->apellido ,
                'calificacion' => $solicitud->calificacion,
                'valor' => $solicitud->valor,
            ],
            'estatus' => EstatusSolicitud::all('id','descripcion'),
            'personal' => Personal::all('id', 'nombre','apellido'),
            'actividades' => Actividad::all('id', 'descripcion'),
            //'actividades' => Auth::user()->perfil_personal->departamento->actividades,
            'periodos' => Periodo::all('id', 'descripcion'),
            'hasRole' =>[
                'admin' => Auth::user()>hasRole('admin'),
                'departamento' => Auth::user()>hasRole('departamento'),
                'alumno' => Auth::user()>hasRole('alumno'),
                'escolares' => Auth::user()->hasRole('escolares'),
            ],
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

        if(Auth::user()->hasRole('departamento')){
            $request->validate([
                'actividad_id' => 'exists:actividades,id|required',
                'periodo_id' => 'exists:periodos,id| required',
                'estatus_id' => 'exists:estatus_solicitud,id|required',
                'calificacion' => 'required|integer|numeric|min:0|max:100',
                'valor' => Rule::in([0.5,1.0,2.0]),
            ]);
            $solicitud->actividad_id = $request->actividad_id;
            $solicitud->periodo_id = $request->periodo_id;
            $solicitud->estatus_id = $request->estatus_id;
            $solicitud->calificacion = $request->calificacion;
            $solicitud->valor = $request->valor; 

            $solicitud->responsable_id = Auth::user()->perfil_personal->id;
            $solicitud->save();

            return Redirect::route('departamento.solicitudes'); 
        }
        $alumno = Alumno::findOrFail($request->no_control);
        $validated = $request->validate([
            'actividad_id' => 'exists:actividades,id|required',
            'periodo_id' => 'exists:periodos,id|required',
            'departamento_id' => 'exists:departamentos,id|required',
            /* 'no_control', => $alumno->no_control, */
            'estatus_id' => 'exists:estatus_solicitud,id |required',
            'responsable_id' => 'exists:personal,id| required',
            'calificacion' => 'required|integer|numeric|min:0|max:100',
            'valor' => Rule::in([0.5,1.0,2.0]),
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
