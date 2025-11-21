<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    // Clave primaria personalizada
    protected $primaryKey = 'id_alumno';
    public $incrementing = false;

    protected $fillable = [
        'businame',
        'typeidenti',
        'valueidenti',
        'address',
        'email',
        'phone',
        'notes',
        'alumno_id', // muy importante para representante
    ];

    // Relación inversa
    public function alumno()
    {
        return $this->belongsTo(Alumno::class, 'alumno_id', 'id');
    }

    public static function rules($id)
    {
        // Nuevo registro (id <= 0 ó null)
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

        // Edición: IGNORAR el registro actual usando id_alumno
        return [
            'businame'    => "required|min:3|string|unique:customers,businame,{$id},id_alumno",
            'typeidenti'  => 'required',
            'valueidenti' => "required|max:13|unique:customers,valueidenti,{$id},id_alumno",
            'address'     => 'required',
            'email'       => "required|email|unique:customers,email,{$id},id_alumno",
            'phone'       => 'required',
        ];
    }

    public static $messages = [
        'businame.required' => 'nombre requerido',
        'businame.min'      => 'nombre debe tener al menos 3 caracteres',
        'businame.unique'   => 'nombre ya esta en uso',

        'typeidenti.required' => 'tipo requerido',

        'valueidenti.required' => 'valor requerido',
        'valueidenti.max'      => 'valor debe tener maximo 13 caracteres',
        'valueidenti.unique'   => 'valor ya esta en uso',

        'address.required' => 'direccion es requerida',

        'email.required' => 'email es requerido',
        'email.email'    => 'email no es válido',
        'email.unique'   => 'email ya esta en uso',

        'phone.required' => 'teléfono es requerido',
    ];

    /**
     * Guardar o actualizar un customer usando la PK real (id_alumno),
     * sin usar la columna "id" en ningún momento.
     */
    public static function storeFromForm($key, array $data): self
    {
        // Si viene clave (editar)
        if (!empty($key)) {
            $model = static::find($key); // buscar por id_alumno

            if ($model) {
                $model->fill($data);
                $model->save();
                return $model;
            }
        }

        // Si no hay clave, o no se encontró → crear nuevo
        $model = new static();
        $model->fill($data);
        $model->save();

        return $model;
    }
}
