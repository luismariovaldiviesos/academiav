<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
Use App\Models\Alumno;
Use App\Models\FichaDeportiva  as FichaDeportiva;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\Image;
use App\Models\Lesion;


class Alumnos extends Component
{

    use WithPagination , WithFileUploads;


     public $action = 'Listado', $componentName = 'ALUMNOS', $search = '', $form = false, $selected_id = 0;
    private $pagination =10;
    protected $paginationTheme = 'tailwind';


    //variables para perfil
    public $ci, $nombres, $fecha_nacimiento, $colegio, $genero, $foto;

    //alumno para todas las fichas
    public $alumno;

    public string $tab = 'perfil';


    // Campos de la ficha (bindéalos en el form de la pestaña Ficha)
    public $datos_camiseta, $numero_camiseta, $talla_camiseta,  $posicion_principal, $otra_posicion, $lateralidad, $academia_anterior, $años_practica;

    // lesiones
    public $alumno_id,  $lesion_fecha, $lesion, $parte, $gravedad, $estado, $notas;

    // Para el listado (historial) en la tabla
    public $lesionesList = []; // array para mostrar rápidamente tras guardar


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

        $this->alumno = $alumno;
        $this->selected_id = $alumno->id;
        $this->ci = $alumno->ci;
        $this->nombres = $alumno->nombres;
        $this->fecha_nacimiento = $alumno->fecha_nacimiento;
        $this->colegio = $alumno->colegio;
        $this->genero = $alumno->genero;
        //ficha
        $this->datos_camiseta = $alumno->fichaDeportiva?->datos_camiseta;
        $this->numero_camiseta = $alumno->fichaDeportiva?->numero_camiseta;
        $this->talla_camiseta = $alumno->fichaDeportiva?->talla_camiseta;
        $this->posicion_principal = $alumno->fichaDeportiva?->posicion_principal;
        $this->otra_posicion = $alumno->fichaDeportiva?->otra_posicion;
        $this->lateralidad = $alumno->fichaDeportiva?->lateralidad;
        $this->academia_anterior = $alumno->fichaDeportiva?->academia_anterior;
        $this->años_practica = $alumno->fichaDeportiva?->años_practica;

        $this->action = 'Editar';
        $this->form = true;


    }
    // --- pestaña activa (opcional si luego entanglas con Alpine) ---
   //

    // --- MÉTODOS QUE LLAMAN LAS PESTAÑAS (solo dd para verificar flujo) ---
    public function savePerfil()
    {
        $this->validate(Alumno::rules($this->selected_id), Alumno::$messages);

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
       $this->tab = 'ficha'; // avanzar a Ficha
    }



    public function saveFicha()
    {
        // Validación

        $alumno =  Alumno::find($this->selected_id);
        //dd($this->datos_camiseta, $this->numero_camiseta, $this->talla_camiseta,  $this->posicion_principal, $this->otra_posicion, $this->lateralidad, $this->academia_anterior, $this->años_practica);
        if (!$alumno) {
            //$this->dispatch('noty', msg: 'Primero guarda el PERFIL del alumno.', type: 'error');
             $this->noty('Primero guarda el PERFIL del alumno.', 'noty', false, 'close-modal');
            $this->tab = 'perfil';
            return;
        }
        // Crear o actualizar ficha deportiva
        //$this->validate(FichaDeportiva::rules(), FichaDeportiva::$messages);
        $this->validate(FichaDeportiva::rules(), FichaDeportiva::$messages);
        $alumno->fichaDeportiva()->updateOrCreate(
            [],
            [
                'datos_camiseta'     => $this->datos_camiseta,
                'numero_camiseta'    => $this->numero_camiseta,
                'talla_camiseta'     => $this->talla_camiseta,
                'posicion_principal' => $this->posicion_principal,
                'otra_posicion'      => $this->otra_posicion,
                'lateralidad'        => $this->lateralidad,
                'academia_anterior'  => $this->academia_anterior,
                'años_practica'      => $this->años_practica,
            ]
        );
        // Notificación + AVANZAR pestaña
        $this->noty('Ficha deportiva guardada', 'noty', false, 'close-modal');
        // $this->resetUI(); // si necesitas
        $this->tab = 'lesiones'; // <-- Avanza automáticamente a la siguiente
        $this->alumno = $alumno; // asigna el alumno cargado
    }

    public function addLesion()
    {
        //dd($this->alumno);
        $this->validate(Lesion::rules(), Lesion::$messages);
        if(!$alumno ){
            $this->noty('Primero guarda la ficha deportiva del alumno.', 'noty', false, 'close-modal');
            $this->tab = 'ficha';
            return;
        }
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
