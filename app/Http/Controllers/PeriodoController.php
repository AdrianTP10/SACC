<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Periodo;
use App\Models\Estatus;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class PeriodoController extends Controller
{
    public function __construct()
    {
        /* $this->middleware('can:periodo.index')->only('index');
        $this->middleware('can:periodo.create')->only('create','store');
        $this->middleware('can:periodo.edit')->only('edit','update');
        $this->middleware('can:periodo.destroy')->only('destroy'); */
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Periodo/Index',[
            'periodos' => Periodo::all()->map(function ($periodo) {
                return [
                    'id' => $periodo->id,
                    'descripcion' => $periodo->descripcion,
                    'estatus' => $periodo->estatus->descripcion
                ];
            }),
         
            /* 'can' =>[
                'solicitud_index' => Auth::user()->can('solicitud.index'),
                'solicitud_edit' => Auth::user()->can('solicitud.edit'),
                'solicitud_create' => Auth::user()->can('solicitud.create'),
            ] */ 

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
        return Inertia::render('Periodo/Create',[
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
        $validated=$request->validate([
            'descripcion' => 'required|string|max:191',
            'estatus_id' => 'exists:estatus,id| required',
        ]);

        Periodo::create($validated);
        return Redirect::route('periodo.index');
    }

 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Periodo  $periodo
     * @return \Illuminate\Http\Response
     */
    public function edit(Periodo $periodo)
    {
        return Inertia::render('Periodo/Edit',[
            'periodo' => 
            [
                'id' => $periodo->id,
                'descripcion' => $periodo->descripcion,
                'estatus_id' => $periodo->estatus->id

            ],
            'estatus' => Estatus::all('id','descripcion'),
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Periodo  $periodo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Periodo $periodo)
    {
        $validated=$request->validate([
            'descripcion' => 'required|string|max:191',
            'estatus_id' => 'exists:personal,id| required',
        ]);
       
        $periodo->update($validated);
        return Redirect::route('periodo.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Periodo  $periodo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Periodo $periodo)
    {
        $periodo->delete();
    }
}
