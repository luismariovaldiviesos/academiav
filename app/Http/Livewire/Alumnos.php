<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
Use App\Models\Alumno;

class Alumnos extends Component
{

    use WithPagination;

     public $ci = "", $nombre ="", $fecha_nacimiento ="",$colegio ="",$genero ="";
     public $action = 'Listado', $componentName = 'ALUMNOS', $search = '', $form = false;
    private $pagination =10;
    protected $paginationTheme = 'tailwind';


    //para los tabs
    public $tabPerfil = true, $tabFichaDep = false, $tabLesiones = false, $tabRepresentante =false, $tabMatricula=false,
            $tabFinanzas = false;



             public $pcs, $laptops ,$monitores, $teclados, $mouses, $telefonos, $scanners, $impresoras;
    public $totpcs, $totlaptops ,$totmonitores, $totteclados, $totmouses, $tottelefonos, $totscanners, $totimpresoras;


      public function render()
    {
        if (strlen($this->search)> 0) {
            $alumnos = Alumno::where('nombre','like',"%{$this->search}%")
            ->orWhere('ci','like',"%{$this->search}%")
            ->orderBy('nombre', 'asc')
            ->paginate($this->pagination);
        }
        else
        {
            $alumnos = Alumno::orderBy('nombre', 'asc')
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

        // $this->selected_id = $customer->id;
        // $this->businame = $customer->businame;
        // $this->typeidenti = $customer->typeidenti;
        // $this->valueidenti = $customer->valueidenti;
        // $this->address = $customer->address;
        // $this->email = $customer->email;
        // $this->phone = $customer->phone;
        // $this->notes = $customer->notes;
        // $this->form = true;

    }

    //  public function setTabActive($tabName)
    // {
    //     if ($tabName == 'tabPerfil') {
    //         $this->tabPerfil = true;
    //         $this->tabFichaDep = false;
    //         $this->tabLesiones = false;
    //         $this->tabRepresentante = false;
    //         $this->tabMatricula = false;
    //         $this->tabFinanzas = false;

    //     }
    //     if ($tabName == 'tabFichaDep') {
    //         $this->tabPerfil = false;
    //         $this->tabFichaDep = true;
    //         $this->tabLesiones = false;
    //         $this->tabRepresentante = false;
    //         $this->tabMatricula = false;
    //         $this->tabFinanzas = false;

    //     }
    //     if ($tabName == 'tabLesiones') {
    //         $this->tabPerfil = false;
    //         $this->tabFichaDep = false;
    //         $this->tabLesiones = true;
    //         $this->tabRepresentante = false;
    //         $this->tabMatricula = false;
    //         $this->tabFinanzas = false;

    //     }
    //     if ($tabName == 'tabRepresentante') {
    //         $this->tabPerfil = false;
    //         $this->tabFichaDep = false;
    //         $this->tabLesiones = false;
    //         $this->tabRepresentante = true;
    //         $this->tabMatricula = false;
    //         $this->tabFinanzas = false;

    //     }
    //     if ($tabName == 'tabMatricula') {
    //         $this->tabPerfil = false;
    //         $this->tabFichaDep = false;
    //         $this->tabLesiones = false;
    //         $this->tabRepresentante = false;
    //         $this->tabMatricula = true;
    //         $this->tabFinanzas = false;

    //         $this->tabImpresoras = false;
    //     }
    //     if ($tabName == 'tabFinanzas') {
    //         $this->tabPerfil = false;
    //         $this->tabFichaDep = false;
    //         $this->tabLesiones = false;
    //         $this->tabRepresentante = false;
    //         $this->tabMatricula = false;
    //         $this->tabFinanzas = true;

    //     }



    // }

    // --- pestaña activa (opcional si luego entanglas con Alpine) ---
public string $tab = 'perfil';

// --- MÉTODOS QUE LLAMAN LAS PESTAÑAS (solo dd para verificar flujo) ---
public function savePerfil()
{
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

// Helper opcional por si quieres cambiar de tab desde Livewire
public function irA($tab)
{
    $this->tab = $tab;
}




}
