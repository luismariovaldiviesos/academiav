<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Categoria;

class Categorias extends Component
{
    use WithPagination;

     public $action = 'Listado', $componentName = 'CATEGORIAS', $search = '', $form = false;
    private $pagination =10;
    protected $paginationTheme = 'tailwind';
    public $selected_id = 0;
    public $nombre;
    public $descripcion;
    public $edad_minima;
    public $edad_maxima;
    public $costo_mensual;

     public function resetUI()
    {
        $this->resetPage();
        $this->resetValidation();
        $this->reset('nombre','descripcion','edad_minima','edad_maxima','costo_mensual','selected_id','search','form');
    }

     public $listeners = ['resetUI', 'Destroy'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

   public function render()
    {
        if (strlen($this->search)> 0) {
            $categorias = Categoria::where('nombre','like',"%{$this->search}%")
            ->orderBy('edad_minima', 'asc')
            ->paginate($this->pagination);
        }
        else
        {
            $categorias = Categoria::orderBy('edad_minima', 'asc')
            ->paginate($this->pagination);
        }
        return view('livewire.categorias.component',[
            'categorias' => $categorias

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

   


   

    public function create()
    {
        $this->resetUI();
        $this->dispatch('show-modal'); // mismo patrón que Customers
    }

    public function Edit(Categoria $categoria)
    {
        $this->selected_id   = $categoria->id;
        $this->nombre        = $categoria->nombre;
        $this->descripcion   = $categoria->descripcion;
        $this->edad_minima   = $categoria->edad_minima;
        $this->edad_maxima   = $categoria->edad_maxima;
        $this->costo_mensual = $categoria->costo_mensual;

         $this->form = true;
    }

    public function Store()
    {
        $this->costo_mensual = $this->costo_mensual === '' ? null : $this->costo_mensual;

        $this->validate(
            Categoria::rules($this->selected_id),
            Categoria::$messages
        );

        if ($this->edad_minima >= $this->edad_maxima) {
            $this->addError('edad_maxima', 'La edad máxima debe ser mayor que la edad mínima');
            return;
        }

        Categoria::updateOrCreate(
            ['id' => $this->selected_id],
            [
                'nombre'        => $this->nombre,
                'descripcion'   => $this->descripcion,
                'edad_minima'   => $this->edad_minima,
                'edad_maxima'   => $this->edad_maxima,
                'costo_mensual' => $this->costo_mensual,
            ]
        );

        $this->noty($this->selected_id > 0 ? 'Categoria actualizada ' : 'Categoria registrada', 'noty', false, 'close-modal' );
         $this->resetUI();
    }

    public function Destroy(Categoria $categoria)
    {
        //dd($categoria);
        $categoria->delete();
        $this->noty('Categoría eliminada', 'noty', false);
        $this->resetUI();
    }
}