<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    use HasFactory;

    protected $table = "carreras";

    public function actividades(){
        return $this->hasMany(Alumno::class);
    }
}
