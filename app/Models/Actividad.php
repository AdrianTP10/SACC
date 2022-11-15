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
        'valor_curricular',
        'estatus_id',
        'valor',
    ];

    


    public function estatus(){
        return $this->belongsTo(Estatus::class, 'estatus_id');
    }

    public function solicitudes(){
        return $this->hasMany(Solicitud::class);
    }
}
