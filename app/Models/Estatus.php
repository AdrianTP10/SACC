<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Actividad;
use App\Models\Alumno;

class Estatus extends Model
{
    use HasFactory;

    protected $table = "estatus";

    public function actividades(){
        return $this->hasMany(Actividad::class);
    }

    public function alumnos(){
        return $this->hasMany(Alumno::class);
    }

    
}
