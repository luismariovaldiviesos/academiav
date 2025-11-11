<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesion extends Model
{
    use HasFactory;
    protected $table = 'lesions';
    protected $fillable = [
            'alumno_id','fecha','lesion','parte','gravedad','estado','notas',
        ];

       public static function rules(){ // stattic para acceder sin tener que instanciar la clase

        return [
            'fecha' => 'required|date',
            'lesion'     => 'required',
            'parte' => 'required',
            'gravedad'     => 'required|in:Leve,Moderada,Grave',
            'estado'        => 'required|in:Activa,Alta,En rehabilitación',
            'notas'  => 'max:255'
                ];
        }


        public  static $messages =[
        'fecha.required' => 'La fecha de la lesión es obligatoria',
        'fecha.date' => 'La fecha de la lesión no es válida',
        'lesion.required' => 'El tipo de lesión es obligatorio',
        'parte.required' => 'La parte del cuerpo es obligatoria',
        'gravedad.required' => 'La gravedad de la lesión es obligatoria',
        'gravedad.in' => 'La gravedad seleccionada no es válida',
        'estado.required' => 'El estado de la lesión es obligatorio',
        'estado.in' => 'El estado seleccionado no es válido',
        'notas.max' => 'Las notas no deben exceder los 255 caracteres'
    ];

    public function alumno()
    {
        return $this->belongsTo(Alumno::class);
    }

}
