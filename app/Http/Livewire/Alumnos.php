<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
Use App\Models\Alumno;
use Livewire\WithFileUploads;

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
        $this->reset('businame','typeidenti','valueidenti','address','email','phone','notes','selected_id','search','form');
    }

     public function Edit(Alumno $alumno){

        dd("editar", $alumno->nombre);


    }
    // --- pestaña activa (opcional si luego entanglas con Alpine) ---
    public string $tab = 'perfil';

    // --- MÉTODOS QUE LLAMAN LAS PESTAÑAS (solo dd para verificar flujo) ---
    public function savePerfil()
    {
        $this->validate(Alumno::rules($this->selected_id), Alumno::$messages);
        dd('aquí grabamos PERFIL');
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
