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
        'departamento_id',
        'user_id'
    ];

    

    public function solicitudes(){
        return $this->hasMany(Solicitud::class);
    }



    //Relacion Uno a Uno inversa
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //Relacion Uno a Uno inversa
    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }
}
