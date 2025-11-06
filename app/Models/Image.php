<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['model_id', 'model_type', 'file', 'description'];

    public function model (){
        return $this->morphTo();
    }

       // URL pública basada en tu convención "storage/alumnos/{file}"
    public function getUrlAttribute(): string
    {
        // Para categorías usarías 'categories', para alumnos 'alumnos'
        // Acá no sabemos el tipo, así que la URL final la armaremos en el modelo dueño (Alumno)
        return '';
    }
}
