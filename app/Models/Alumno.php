<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;

    protected $table = "alumnos";

    protected $fillable = [
        'nombre',
        'apellido',
        'no_control',
        'semestre',
        'carrera_id',
        'estatus_id',
    ];

    protected $hidden = ['id'];


    public function estatus(){
        return $this->belongsTo(Estatus::class, 'estatus_id');
    }

    public function carrera(){
        return $this->belongsTo(Carrera::class, 'carrera_id');
    }
}
