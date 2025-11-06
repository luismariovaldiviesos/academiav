<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Alumno extends Model
{
    use HasFactory;
    protected $fillable = ['ci','nombres','fecha_nacimiento','colegio','genero'];

    public static function rules($id){ // stattic para acceder sin tener que instanciar la clase

        if($id <=0 ){
            return [
               'ci' => 'required|digits:10|numeric|unique:alumnos',
                'nombres' => 'required|unique:alumnos',
                'fecha_nacimiento' => 'required',
                'colegio' => 'required',
                 'foto' => 'image|max:1024|required' // 1MB
            ];
        }

        else{
            return [
                'ci' => "required|digits:10|numeric|unique:alumnos,ci,{$id}",
                'nombres' => "required|unique:alumnos,nombres,{$id}",
                'fecha_nacimiento' => 'required',
                'colegio' => 'required',
                'foto' => 'image|max:1024|required' // 1MB
            ];

        }
    }

      public static $messages =[
        'ci.required' => 'Cédula del estudiante es requerido',
        'ci.digits' => 'cédula  debe tener  10 caracteres',
        'ci.unique' => '# de cédula  ya esta en uso',
        'ci.numeric' => 'Cédula debe ser numérico',
        'nombres.required' => 'Nombre del alumno es  requerido',
        'nombres.unique' => 'Nombre del alumno ya esta en uso',
        'fecha_nacimiento.required' => 'Fecha de nacimiento es requerida',
        'colegio.required' => 'Colegio o escuela  es requerida',
        'foto.image' => 'El archivo no es una imagen válida',
        'foto.max' => 'La imagen no debe pesar más de 1MB',
        'foto.required' => 'La foto del alumno es requerida',
    ];



  // Relación uno a uno con Representante
    public function representante()
    {
        return $this->hasOne(Customer::class, 'alumno_id', 'id');
    }

    public function image()
    {
        //Este patrón a menudo se denomina patrón de objeto nulo y puede ayudar a eliminar las comprobaciones condicionales en su código.
        return  $this->morphOne(Image::class, 'model')->withDefault();
    }



    // Accessor para usar en blade: {{ $alumno->img }}
    public function getImgAttribute()
    {
        $img = $this->image->file;

        if ($img != null) {
            if (file_exists('storage/alumnos/' . $img))
                return 'storage/alumnos/' . $img;
            else
            return "storage/default_avatar.JPG";  // si el producto tiene imagen pero fisiscamente no se encuentra
        }

        return 'storage/noimg.png'; // si el producto no  tiene imagen relacionada
    }


     protected static function booted()
    {
        static::deleting(function (Alumno $alumno) {
            $file = $alumno->image?->file;
            if ($file && Storage::exists('public/alumnos/'.$file)) {
                Storage::delete('public/alumnos/'.$file);
            }
            $alumno->image()?->delete();
        });
    }


    public function fichaDeportiva()
    {
        return $this->hasOne(FichaDeportiva::class);
    }


}
