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

     public static function rules(){ // stattic para acceder sin tener que instanciar la clase

        return [
            'datos_camiseta'     => 'required|string|max:120',
            'numero_camiseta'    => 'required|integer|min:0|max:999',
            'talla_camiseta'     => 'required|string|max:10',
            'posicion_principal' => 'required|string|max:50',
            'otra_posicion'     => 'required|string|max:50',
            'lateralidad'        => 'required|string|max:20',
            'academia_anterior'  => 'required|string|max:120',
            'años_practica'      => 'required|integer|min:0|max:999'
                ];


    }

         public static $messages =[
        'datos_camiseta.string' => 'El nombre de la camiseta debe ser una cadena de texto',
       'datos_camiseta.max' => 'El nombre de la camiseta no debe exceder los 120 caracteres',
       'datos_camiseta.required' => 'El nombre de la camiseta es obligatorio',
       'numero_camiseta.required' => 'El número de camiseta es obligatorio',
        'numero_camiseta.integer' => 'El número de camiseta debe ser un número entero',
        'numero_camiseta.min' => 'El número de camiseta no puede ser negativo',
        'numero_camiseta.max' => 'El número de camiseta no puede exceder 999',
        'talla_camiseta.required' => 'La talla de la camiseta es obligatoria',
        'talla_camiseta.string' => 'La talla de la camiseta debe ser una cadena de texto',
        'talla_camiseta.max' => 'La talla de la camiseta no debe exceder los 10 caracteres',
        'posicion_principal.required' => 'La posición principal es obligatoria',
        'posicion_principal.string' => 'La posición principal debe ser una cadena de texto',
        'posicion_principal.max' => 'La posición principal no debe exceder los 50 caracteres',
        'otra_posicion.string' => 'La otra posición debe ser una cadena de texto',
        'otra_posicion.max' => 'La otra posición no debe exceder los 50 caracteres',
        'otra_posicion.required' => 'La otra posición es obligatoria',
        'lateralidad.required' => 'La lateralidad es obligatoria',
        'academia_anterior.required' => 'La academia anterior es obligatoria',
        'años_practica.required' => 'Los años de práctica son obligatorios',
        'lateralidad.string' => 'La lateralidad debe ser una cadena de texto',
        'lateralidad.max' => 'La lateralidad no debe exceder los 20 caracteres',
        'academia_anterior.string' => 'La academia anterior debe ser una cadena de texto',
        'academia_anterior.max' => 'La academia anterior no debe exceder los 120 caracteres',
        'años_practica.integer' => 'Los años de práctica deben ser un número entero',
        'años_practica.min' => 'Los años de práctica no pueden ser negativos',
        'años_practica.max' => 'Los años de práctica no pueden exceder 999',
    ];




    public function alumno()
    {
        return $this->belongsTo(Alumno::class);
    }
}
