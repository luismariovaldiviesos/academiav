<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Entrenador;
use App\Models\Categoria;

class Entrenadores extends Component
{

      use WithPagination;
     public $action = 'Listado', $componentName = 'ENTRENADORES', $search = '', $form = false,  $selected_id =0;
    private $pagination =10;
    protected $paginationTheme = 'tailwind';

    public $nombre;
    public $ci;
    public $telefono;
    public $email;
    public $notas;

    public $categoriasSeleccionadas = []; // array de categoria_id

    public function render()
    {
        $query =  Entrenador::with('categorias');
       if ($this->search) {
            $query->where(function ($q) {
                $q->where('nombre', 'like', '%' . $this->search . '%')
                  ->orWhere('ci', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%');
            });
        }
        $entrenadores =  $query->orderBy('nombre')->paginate($this->pagination);
        $allCategorias = Categoria::orderBy('edad_minima')->get();
        return view('livewire.entrenadores.component',[
            'entrenadores' => $entrenadores,
            'allCategorias' => $allCategorias

        ])->layout('layouts.theme.app');
    }
    //*************SIEMPRE VA *************** */
     public $listeners = ['resetUI', 'Destroy'];

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
        $this->reset('nombre','ci','telefono','email','notas','selected_id','search','form','categoriasSeleccionadas');
    }

    //************* FIN  SIEMPRE VA  CAMBIAR VARIABLES DEL RESET *************** */


    // ... CRUDS ...  ///


    public function Edit(Entrenador $entrenador){

        $this->selected_id = $entrenador->id;
        $this->nombre = $entrenador->nombre;
        $this->ci = $entrenador->ci;
        $this->telefono = $entrenador->telefono;
        $this->email = $entrenador->email;
        $this->notas = $entrenador->notas;

        // Cargar las categorías seleccionadas
        $this->categoriasSeleccionadas = $entrenador->categorias()->pluck('categoria_id')->toArray();

        $this->form = true;

    }

      public function Store()
    {
        $this->validate(Entrenador::rules($this->selected_id), Entrenador::$messages);

       $entrenador = Entrenador::updateOrCreate(
            ['id' => $this->selected_id],
            [
                'nombre' => $this->nombre,
                'ci' => $this->ci,
                'telefono' => $this->telefono,
                'email' => $this->email,
                'notas' => $this->notas
            ]

            );
             //sincronizar categorias
             $entrenador->categorias()->sync($this->categoriasSeleccionadas ?? []);
            $this->noty($this->selected_id > 0 ? 'Entrenador actualizado ' : 'Entrenador registrado', 'noty', false, 'close-modal' );
            $this->resetUI();

    }

       public function Destroy(Entrenado $entrenador)
    {
        // if($customer->orders->count() < 1)
        // {
        //     $customer->delete();
        //     $this->noty("El cliente <b>$customer->businame </b> ha sido elmininado");
        // }else{
        //     $this->noty("El cliente tiene ventas relacionadas, no es posible eliminarlo");
        // }
        $entrenador->delete();
       $this->noty("El cliente <b>$entrenador->nombre </b> ha sido elmininado");
    }

}
