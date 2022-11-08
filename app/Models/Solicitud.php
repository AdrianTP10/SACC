<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;
    protected $table = "solicitudes";

    protected $fillable = [
        'alumno_id',
        'actividad_id',
        'periodo_id',
        'departamento_id',
        'responsable_id',
        'estatus_id',
        'calificacion',
    ];

    public function alumno(){
        return $this->belongsTo(Alumno::class, 'alumno_id');
    }

    public function actividad(){
        return $this->belongsTo(Actividad::class, 'actividad_id');
    }

    public function periodo(){
        return $this->belongsTo(Periodo::class, 'periodo_id');
    }

    public function departamento(){
        return $this->belongsTo(Departamento::class, 'departamento_id');
    }

    public function responsable(){
        return $this->belongsTo(Personal::class, 'responsable_id');
    }

    public function estatus(){
        return $this->belongsTo(EstatusSolicitud::class, 'estatus_id');
    }
}
