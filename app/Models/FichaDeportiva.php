<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FichaDeportiva extends Model
{
    use HasFactory;
     protected $table = 'ficha_deportivas';
        protected $fillable = [
        'alumno_id',
        'datos_camiseta',
        'numero_camiseta',
        'talla_camiseta',
        'posicion_principal',
        'otra_posicion',
        'lateralidad',
        'academia_anterior',
        'años_practica'
    ];


    public function alumno()
    {
        return $this->belongsTo(Alumno::class);
    }
}
