<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;
    protected $table = "solicitudes";

    public function estatus(){
        return $this->belongsTo(EstatusSolicitud::class, 'estatus_id');
    }
}
