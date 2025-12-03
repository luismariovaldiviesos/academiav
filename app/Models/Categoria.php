<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Entrenador;
class Categoria extends Model
{
     use HasFactory;

    protected $table = 'categorias';

    protected $fillable = [
        'nombre',
        'descripcion',
        'edad_minima',
        'edad_maxima',
        'costo_mensual',
    ];

    public static function rules($id = 0)
    {
        if ($id <= 0 || $id === null) {
            // crear
            return [
                'nombre'        => 'required|min:3|unique:categorias,nombre',
                'edad_minima'   => 'required|integer|min:3|max:18',
                'edad_maxima'   => 'required|integer|gte:edad_minima|max:21',
                'costo_mensual' => 'required|numeric|min:0',
                'descripcion'   => 'nullable|string|max:255',
            ];
        }

        // editar
        return [
            'nombre'        => "required|min:3|unique:categorias,nombre,{$id},id",
            'edad_minima'   => 'required|integer|min:3|max:18',
            'edad_maxima'   => 'required|integer|gte:edad_minima|max:21',
            'costo_mensual' => 'required|numeric|min:0',
            'descripcion'   => 'nullable|string|max:255',
        ];
    }

    public static $messages = [
        'nombre.required' => 'El nombre es obligatorio',
        'nombre.min'      => 'El nombre debe tener al menos 3 caracteres',
        'nombre.unique'   => 'Ya existe una categoría con ese nombre',

        'edad_minima.required' => 'La edad mínima es obligatoria',
        'edad_minima.integer'  => 'La edad mínima debe ser un número entero',

        'edad_maxima.required' => 'La edad máxima es obligatoria',
        'edad_maxima.integer'  => 'La edad máxima debe ser un número entero',
        'edad_maxima.gte'      => 'La edad máxima debe ser mayor o igual a la mínima',

        'costo_mensual.required' => 'El costo mensual es obligatorio',
        'costo_mensual.numeric'  => 'El costo mensual debe ser numérico',
        'costo_mensual.min'      => 'El costo mensual no puede ser negativo',

        'descripcion.max' => 'La descripción debe tener máximo 255 caracteres',
    ];

    public function entrenadores()
    {
        return $this->belongsToMany(Entrenador::class, 'categoria_entrenador', 'categoria_id', 'entrenador_id')->withTimestamps();      

    }

}
