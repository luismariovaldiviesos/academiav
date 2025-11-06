<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
Use App\Models\Alumno;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\Image;


class Alumnos extends Component
{

    use WithPagination , WithFileUploads;


     public $action = 'Listado', $componentName = 'ALUMNOS', $search = '', $form = false, $selected_id = 0;
    private $pagination =10;
    protected $paginationTheme = 'tailwind';


    //variables para perfil
    public $ci, $nombres, $fecha_nacimiento, $colegio, $genero, $foto;





      public function render()
    {
        if (strlen($this->search)> 0) {
            $alumnos = Alumno::where('nombres','like',"%{$this->search}%")
            ->orWhere('ci','like',"%{$this->search}%")
            ->orderBy('nombres', 'asc')
            ->paginate($this->pagination);
        }
        else
        {
            $alumnos = Alumno::orderBy('nombres', 'asc')
            ->paginate($this->pagination);
        }
        return view('livewire.alumnos.component',[
            'alumnos' => $alumnos

        ])->layout('layouts.theme.app');
    }

     public function noty($msg, $eventName = 'noty', $reset = true, $action =""){
        $this->dispatchBrowserEvent($eventName, ['msg'=>$msg, 'type' => 'success', 'action' => $action ]);
        if($reset) $this->resetUI();
    }

       public function  addNew()
    {
        $this->resetUI();
        $this->form = true;
        $this->action = 'Agregar';
    }

      public  function  CloseModal()
    {
        $this->resetUI();
        $this->noty(null, 'close-modal');
    }

        public function resetUI()
    {
        $this->resetPage();
        $this->resetValidation();
        $this->reset('ci','nombres','fecha_nacimiento','colegio','genero','selected_id','search','form');
    }

     public function Edit(Alumno $alumno){

        dd("editar", $alumno->nombre);


    }
    // --- pestaña activa (opcional si luego entanglas con Alpine) ---
    public string $tab = 'perfil';

    // --- MÉTODOS QUE LLAMAN LAS PESTAÑAS (solo dd para verificar flujo) ---
   public function savePerfil()
{
    //$this->validate(Alumno::rules($this->selected_id), Alumno::$messages);

    // Asegura formato SQL para DATE
    $fecha_nacimiento_sql = $this->fecha_nacimiento
        ? Carbon::parse($this->fecha_nacimiento)->format('Y-m-d')
        : null;

    DB::transaction(function () use ($fecha_nacimiento_sql) {

        // ¡OJO! updateOrCreate tiene SOLO 2 arrays: [condiciones], [valores]
        $alumno = Alumno::updateOrCreate(
            ['id' => $this->selected_id ?: null],
            [
                // Ajusta el nombre del campo según tu BD: ¿'nombre' o 'nombres'?
                'ci'               => $this->ci,
                'nombres'          => $this->nombres,          // <-- si tu columna es 'nombre', cambia aquí a 'nombre'
                'fecha_nacimiento' => $fecha_nacimiento_sql,   // Y-m-d
                'colegio'          => $this->colegio,
                'genero'           => $this->genero,
            ]
        );
       // dd('aca llegamos', $alumno);
        // Guardar/actualizar imagen (opcional)
        if (!empty($this->foto)) {
            // Borrar archivo anterior si existe
            $oldFile = $alumno->image?->file;
            if ($oldFile && Storage::exists('public/alumnos/'.$oldFile)) {
                Storage::delete('public/alumnos/'.$oldFile);
            }

            // Subir nueva
            $customFileName = uniqid() . '_.' . $this->foto->extension();
            $this->foto->storeAs('public/alumnos', $customFileName);

            // Borrar relación previa (si usas el patrón que mostraste)
            $alumno->image()?->delete();

            // Crear registro en images
            $img = Image::create([
                'model_id'   => $alumno->id,
                'model_type' => 'App\Models\Alumno',  // ¡IMPORTANTE!
                'file'       => $customFileName,
            ]);

            // Asociar
            $alumno->image()->save($img);
        }

        // Actualiza selected_id tras crear
        $this->selected_id = $alumno->id;
    });

    // Feedback y reset si quieres
    $this->noty($this->selected_id ? 'Perfil alumno Registrado' : 'Perfil alumno  Actualizado', 'noty', false, 'close-modal');
    // $this->resetUI(); // si necesitas
}

    public function saveFicha()
    {
        dd('aquí grabamos FICHA TÉCNICA / FICHA DEPORTIVA');
    }

    public function addLesion()
    {
        dd('aquí ABRIMOS MODAL para AGREGAR LESIÓN');
    }

    public function saveRepresentante()
    {
        dd('aquí grabamos REPRESENTANTE');
    }

    public function saveMatricula()
    {
        dd('aquí grabamos MATRÍCULA');
    }

    public function registrarPago()
    {
        dd('aquí REGISTRAMOS un PAGO');
    }

    public function generarCuotaMes()
    {
        dd('aquí GENERAMOS la CUOTA del mes');
    }

    public function saveEvaluacion()
    {
        dd('aquí guardamos EVALUACIÓN (cabecera + métricas)');
    }




}
