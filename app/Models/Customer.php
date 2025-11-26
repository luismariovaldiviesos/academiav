<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    // PK normal
    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = [
        'businame',
        'typeidenti',
        'valueidenti',
        'address',
        'email',
        'phone',
        'notes',
    ];

    // Un representante puede estar asociado a varios alumnos
    public function alumnos()
    {
        return $this->hasMany(Alumno::class, 'representante_id', 'id');
    }

    // ----------------- VALIDACIÓN -----------------

    public static function rules($id = 0)
    {
        // NUEVO
        if ($id <= 0 || $id === null) {
            return [
                'businame'    => 'required|min:3|unique:customers,businame',
                'typeidenti'  => 'required',
                'valueidenti' => 'required|max:13|unique:customers,valueidenti',
                'address'     => 'required',
                'email'       => 'required|email|unique:customers,email',
                'phone'       => 'required',
            ];
        }

        // EDICIÓN: ignorar el registro cuyo PK = $id
        return [
            'businame'    => "required|min:3|unique:customers,businame,{$id},id",
            'typeidenti'  => 'required',
            'valueidenti' => "required|max:13|unique:customers,valueidenti,{$id},id",
            'address'     => 'required',
            'email'       => "required|email|unique:customers,email,{$id},id",
            'phone'       => 'required',
        ];
    }

    public static $messages = [
        'businame.required' => 'nombre requerido',
        'businame.min'      => 'nombre debe tener al menos 3 caracteres',
        'businame.unique'   => 'nombre ya está en uso',

        'typeidenti.required' => 'tipo requerido',

        'valueidenti.required' => 'valor requerido',
        'valueidenti.max'      => 'valor debe tener máximo 13 caracteres',
        'valueidenti.unique'   => 'documento ya está en uso',

        'address.required' => 'dirección requerida',

        'email.required' => 'email es requerido',
        'email.email'    => 'email no es válido',
        'email.unique'   => 'email ya está en uso',

        'phone.required' => 'teléfono requerido',
    ];
}
