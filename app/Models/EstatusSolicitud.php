<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Actividad;

class EstatusSolicitud extends Model
{
    use HasFactory;
    protected $table = "estatus_solicitud";

    public function solicitudes(){
        return $this->hasMany(Actividad::class);
    }
}
