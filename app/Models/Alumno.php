<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;
    protected $fillable = ['ci','nombre','fecha_nacimiento','colegio','genero'];

    public static function rules($id){ // stattic para acceder sin tener que instanciar la clase

        if($id <=0 ){
            return [
                'ci' => 'required|min:10|unique:alumnos',
                'nombre' => 'required|unique:alumnos',
                'fecha_nacimiento' => 'required',
                'colegio' => 'required'
            ];
        }

        else{
            return [
                'ci' => "required|min:10|unique:alumnos,ci,{$id}",
                'nombre' => "required|unique:alumnos,nombre,{$id}",
                'fecha_nacimiento' => 'required',
                'colegio' => 'required'
            ];

        }
    }

      public static $messages =[
        'ci.required' => 'Cédula del estudiante es requerido',
        'ci.min' => 'cédula  debe tener al menos 10 caracteres',
        'ci.unique' => '# de cédula  ya esta en uso',
        'nombre.required' => 'Nombre del alumno es  requerido',
        'nombre.unique' => 'Nombre del alumno ya esta en uso',
        'fecha_nacimiento.required' => 'Fecha de nacimiento es requerida',
        'colegio.required' => 'Colegio o escuela  es requerida',
    ];



  // Relación uno a uno con Representante
    public function representante()
    {
        return $this->hasOne(Customer::class, 'alumno_id', 'id');
    }


}
