<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Actividad;

class Estatus extends Model
{
    use HasFactory;

    protected $table = "estatus";

    public function actividades(){
        return $this->hasMany(Actividad::class);
    }

    
}
