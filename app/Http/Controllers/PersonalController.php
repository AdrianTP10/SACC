<?php

namespace App\Http\Controllers;

use App\Models\Personal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        //Retorna la vista para El personal de un departamento
        if(Auth::user()->hasRole('departamento')){
            return Inertia::render('Personal/Index',[
                'personal' => Personal::where('departamento_id',Auth::user()->perfil_personal->departamento_id)
                ->select('id', 'nombre','apellido','rfc','departamento_id')->get(),
                'hasRole' =>[
                    'admin' => Auth::user()->hasRole('admin'),
                    'departamento' => Auth::user()->hasRole('departamento'),
                    'alumno' => Auth::user()->hasRole('alumno'),
                    'escolares' => Auth::user()->hasRole('escolares'),
                ],
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
        return Inertia::render('Personal/Index',[
            'personal' => Personal::all('id','nombre','apellido','rfc'),
            'hasRole' =>[
                'admin' => Auth::user()->hasRole('admin'),
                'departamento' => Auth::user()->hasRole('departamento'),
                'alumno' => Auth::user()->hasRole('alumno'),
                'escolares' => Auth::user()->hasRole('escolares'),
            ],
            'can' =>[
                'personal_index' => Auth::user()->hasPermissionTo('personal.index'),
                'personal_edit' => Auth::user()->hasPermissionTo('personal.edit'),
                'personal_create' => Auth::user()->hasPermissionTo('personal.create'),
                'solicitud_index' => Auth::user()->hasPermissionTo('solicitud.index'),
                'actividad_index' => Auth::user()->hasPermissionTo('actividad.index'),
                'alumno_index' => Auth::user()->hasPermissionTo('alumno.index'),
                'periodo_index' => Auth::user()->hasPermissionTo('periodo.index'),
                'departamento_index' => Auth::user()->hasPermissionTo('departamento.index'),
            ]
       ]);

    }

    public function create()
    {
        return Inertia::render('Personal/Create',[
            'hasRole' =>[
                'admin' => Auth::user()->hasRole('admin'),
                'departamento' => Auth::user()->hasRole('departamento'),
                'alumno' => Auth::user()->hasRole('alumno'),
                'escolares' => Auth::user()->hasRole('escolares'),
            ],
            'can' =>[
                'personal_index' => Auth::user()->hasPermissionTo('personal.index'),
                'solicitud_index' => Auth::user()->hasPermissionTo('solicitud.index'),
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
        //validamos los datos
        $validated = $request->validate([
            'nombre' => 'required|string|max:191',
            'apellido' => 'required|string|max:191',
            'rfc' => 'required|string|max:13'
        ]);
        Personal::create($validated);
        return Redirect::route('personal.index');
    }

    public function edit(Personal $personal)
    {
        $dato = Personal::findOrFail($personal->id);
        return Inertia::render('Personal/Edit',[
            'personal' => 
            [
                'id' => $dato->id,
                'nombre' => $dato->nombre,
                'apellido' => $dato->apellido,
                'rfc' => $dato->rfc
            ],
            
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Personal  $personal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Personal $personal)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:191',
            'apellido' => 'required|string|max:191',
            'rfc' =>'required|string|max:13',
        ]);

        $personal->update($validated);
        return Redirect::route('personal.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Personal  $personal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Personal $personal)
    {
        $personal->delete();
    }
}
