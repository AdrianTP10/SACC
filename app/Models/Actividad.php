<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Estatus;

class Actividad extends Model
{
    use HasFactory;

    protected $table = "actividades";

    protected $fillable = [
        'descripcion',
        'estatus_id',
        'departamento_id',
        'valor',
    ];

    


    public function estatus(){
        return $this->belongsTo(Estatus::class, 'estatus_id');
    }

    public function departamento(){
        return $this->belongsTo(Departamento::class, 'departamento_id');
    }

    public function solicitudes(){
        return $this->hasMany(Solicitud::class);
    }
}
