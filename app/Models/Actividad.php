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
    ];

    protected $hidden = ['id'];


    public function estatus(){
        return $this->belongsTo(Estatus::class, 'estatus_id');
    }
}
