<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    use HasFactory;

    protected $table = "periodos";
    protected $fillable = [
        'descripcion',
        'estatus_id',
    ];

    public function solicitudes(){
        return $this->hasMany(Solicitud::class);
    }

    public function estatus(){
        return $this->belongsTo(Estatus::class, 'estatus_id');
    }
}
