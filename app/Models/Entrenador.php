<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrenador extends Model
{
    use HasFactory;
    protected $table = 'entrenadores';

    protected $fillable = [
        'nombre',
        'ci',
        'telefono',
        'email',
        'notas',
        
    ];

    //relacion many to many con categorias 
    public function categorias(){
        return $this->belongsToMany(Categoria::class, 'categoria_entrenador', 'entrenador_id', 'categoria_id')->withTimestamps();
    }

    //validaciones 
    public static function rules ($id =0) 
    {
        if($id <=0 || $id == null){
            // Crear
            return [
                'nombre'   => 'required|string|min:3|max:100',
                'ci'       => 'required|string|max:20|unique:entrenadores,ci',
                'telefono' => 'nullable|string|max:15',
                'email'    => 'nullable|email|max:100|unique:entrenadores,email',
                'notas'    => 'nullable|string|max:255',
            ];
        }
        //editar
        return [
            'nombre'   => 'required|string|min:3|max:100',
            'ci'       => 'required|string|max:20|unique:entrenadores,ci,'.$id,
            'telefono' => 'nullable|string|max:15',
            'email'    => 'nullable|email|max:100|unique:entrenadores,email,'.$id,
            'notas'    => 'nullable|string|max:255',
        ];
           
    }

    public static $messages = [
        'nombre.required' => 'El nombre es obligatorio',
        'nombre.min'      => 'El nombre debe tener al menos 3 caracteres',
        'nombre.max'      => 'El nombre debe tener máximo 100 caracteres',

        'ci.required' => 'La cédula es obligatoria',
        'ci.unique'   => 'Ya existe un entrenador con esa cédula',

        'email.email'  => 'El email no es válido',
        'email.unique' => 'Ya existe un entrenador con ese email',

        'telefono.max' => 'El teléfono debe tener máximo 15 caracteres',

        'notas.max'    => 'Las notas deben tener máximo 255 caracteres',
    ];
}
