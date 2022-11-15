<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    use HasFactory;
    protected $table = "personal";

    protected $fillable = [
        'nombre',
        'apellido',
        'rfc',
    ];

    

    public function solicitudes(){
        return $this->hasMany(Solicitud::class);
    }
}
