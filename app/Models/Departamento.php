<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;

    protected $table = "departamentos";

    protected $fillable = [
        'nombre',
        'jefe_id',
    ];

    /* public function solicitudes(){
        return $this->hasMany(Solicitud::class);
    } */
    

    public function jefe(){
        return $this->belongsTo(Personal::class, 'jefe_id');
    }


    public function personal(){
        return $this->hasMany(Personal::class);
    }

    public function actividades(){
        return $this->hasMany(Actividad::class);
    }

    public function solicitudes(){
        return $this->hasManyThrough(Solicitud::class, Actividad::class);
    }
}
