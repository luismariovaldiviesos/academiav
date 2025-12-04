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
use App\Models\Customer;
use App\Models\Categoria;


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
    public $alumno_id,  $fecha, $lesion, $parte, $gravedad, $estado, $notas;

    public $lesiones;

    // Para modo edición de lesión
    public $lesion_id = null;      // id de la lesión que se edita
    public $editModeLesion = false; // bandera para cambiar botón de "Agregar" a "Actualizar"


    //para representante
   public $rep_id = null;  // id en customers (representante actual)
    public $businame;
    public $typeidenti;
    public $valueidenti;
    public $address;
    public $email;
    public $phone;
    public $notes;


    //para matricula
    public $categorias = [];



    public  function mount(){
        $this->categorias = Categoria::orderBy('nombre', 'asc')->get();
        if($this->selected_id >0 ){
            $this->cargarLesiones($this->selected_id);
            $this->loadRepresentante();
        }
    }



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

        //dd( $this->lesionesList = $this->loadLesiones());

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
        $this->cargarLesiones($alumno->id);;
        $this->loadRepresentante();

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



    public function cargarLesiones($id){

        $alumno =  Alumno::find($id);
        $this->lesiones =   $alumno->lesiones()->orderBy('fecha', 'desc')->get();
        //dd('llegamos' , $this->lesiones);
    }

    public function resetLesionInputs()
    {
        $this->lesion_id = null;
        $this->fecha = null;
        $this->lesion = null;
        $this->parte = null;
        $this->gravedad = null;
        $this->estado = null;
        $this->notas = null;
        $this->editModeLesion = false;
    }



    public function addLesion()
    {
        //dd($this->alumno, $this->selected_id);

         if($this->alumno == null){
             $this->noty('Primero guarda la ficha deportiva del alumno.', 'noty', false, 'close-modal');
             $this->tab = 'ficha';
             return;
         }else{
             $this->validate(Lesion::rules(), Lesion::$messages);
               $fecha = Carbon::createFromFormat('Y-m', $this->fecha)->startOfMonth()->format('Y-m-d');
               //insertar
                $l = Lesion::create([
                'alumno_id' => $this->alumno->id,
                'fecha'     => $fecha,
                'lesion'    => trim($this->lesion),
                'parte'     => trim($this->parte) ?: null,
                'gravedad'  => $this->gravedad ?: null,
                'estado'    => $this->estado ?: null,
                'notas'     => trim($this->notas) ?: null,
            ]);
             $this->noty('lesion guardada', 'noty', false, 'close-modal');
            $this->resetLesionInputs();
             $this->cargarLesiones($this->selected_id);

         }
         //$this->validate(Lesion::rules(), Lesion::$messages);

    }

    public function deleteLesion(Lesion $lesion)
    {
        if(!$lesion){
             $this->noty('lesion no se encuentra', 'noty', false, 'close-modal');
             return;}
        $lesion->delete();       
        $this->cargarLesiones($this->selected_id);
         $this->noty('lesion eliminada', 'noty', false);

    }

    public function editLesion(Lesion $lesion)
    {
        if(!$lesion){
             $this->noty('lesion no se encuentra', 'noty', false, 'close-modal');
             return;}
        $this->lesion_id = $lesion->id;
        $this->fecha = Carbon::parse($lesion->fecha)->format('Y-m');
        $this->lesion = $lesion->lesion;
        $this->parte = $lesion->parte;
        $this->gravedad = $lesion->gravedad;
        $this->estado = $lesion->estado;
        $this->notas = $lesion->notas;
        $this->editModeLesion = true;
         $this->noty('lesion cargada para editar', 'noty', false);

    }

    public  function updateLesion()
    {
         $lesion = \App\Models\Lesion::find($this->lesion_id);         
        if (!$lesion) {
            $this->dispatch('noty', msg: 'No se encontró la lesión a actualizar.', type: 'error');
            return;
        }
        // Actualizar los campos
        $lesion->update([
            'fecha'    => \Carbon\Carbon::createFromFormat('Y-m', $this->fecha)->startOfMonth()->format('Y-m-d'),
            'lesion'   => trim($this->lesion),
            'parte'    => trim($this->parte),
            'gravedad' => $this->gravedad,
            'estado'   => $this->estado,
            'notas'    => trim($this->notas),
        ]);

        $this->resetLesionInputs();
        // Recargar lista
        $this->cargarLesiones($this->selected_id);
        $this->noty('lesión actualizada con exto ', 'noty', false);
    }

    //para cargar si hay representante
    public function updatedValueIdenti($value){

        // Si borra la cédula, reseteamos el contexto de representante
        if (!$value) {
            $this->rep_id   = null;
            $this->businame = null;
            $this->typeidenti = null;
            $this->address  = null;
            $this->email    = null;
            $this->phone    = null;
            $this->notes    = null;
            return;
        }

         // Buscar representante por número de documento
         $rep = Customer::where('valueidenti', $value)->first();
         if ($rep) {
             // Cargar datos en los campos
             $this->rep_id      = $rep->id;
             $this->businame    = $rep->businame;
             $this->typeidenti  = $rep->typeidenti;
             $this->address     = $rep->address;
             $this->email       = $rep->email;
             $this->phone       = $rep->phone;
             $this->notes       = $rep->notes;
             // Opcional: notificación amigable
            $this->noty('Representante encontrado y cargado.', 'noty', false);
         } else {
             // No existe: será un representante nuevo con esta cédula
            $this->rep_id = null;
            // Dejamos el resto de campos en blanco para que los llene el usuario
            $this->businame   = null;
            $this->typeidenti = null;
            $this->address    = null;
            $this->email      = null;
            $this->phone      = null;
            $this->notes      = null;

            $this->noty('No existe representante con esa cédula. Se registrará uno nuevo.', 'noty', false);
         }

    }

    public function loadRepresentante()
    {
        // limpiar primero
        $this->rep_id      = null;
        $this->businame    = null;
        $this->typeidenti  = null;
        $this->valueidenti = null;
        $this->address     = null;
        $this->email       = null;
        $this->phone       = null;
        $this->notes       = null;

        if (!$this->selected_id) {
        return;
        }

          $alumno = \App\Models\Alumno::with('representante')->find($this->selected_id);
        if ($alumno && $alumno->representante) {
                
            $rep = $alumno->representante;
            $this->rep_id      = $rep->id;
            $this->businame    = $rep->businame;
            $this->typeidenti  = $rep->typeidenti;
            $this->valueidenti = $rep->valueidenti;
            $this->address     = $rep->address;
            $this->email       = $rep->email;
            $this->phone       = $rep->phone;
            $this->notes       = $rep->notes;
            }
    }

        public function resetRepresentanteInputs()
        {
            $this->rep_id = null;
            $this->businame = null;
            $this->typeidenti = null;
            $this->valueidenti = null;
            $this->address = null;
            $this->email = null;
            $this->phone = null;
            $this->notes = null;
        }

    public function saveRepresentante()
    {
        if (!$this->selected_id) {
            $this->noty('Primero guarda las lesiones del alumno.', 'noty', true);
            $this->tab = 'lesiones';
            return;
        }

        $id = $this->rep_id ?? 0; // 0 = nuevo; >0 = editar

        // Validación según Customer
        $this->validate(Customer::rules($id), Customer::$messages);

        // Si ya hay representante, actualizamos; si no, creamos uno nuevo
        if ($this->rep_id) {
            $rep = Customer::findOrFail($this->rep_id);
            $rep->update([
                'businame'    => $this->businame,
                'typeidenti'  => $this->typeidenti,
                'valueidenti' => $this->valueidenti,
                'address'     => $this->address,
                'email'       => $this->email,
                'phone'       => $this->phone,
                'notes'       => $this->notes,
            ]);
        } else {
            $rep = Customer::create([
                'businame'    => $this->businame,
                'typeidenti'  => $this->typeidenti,
                'valueidenti' => $this->valueidenti,
                'address'     => $this->address,
                'email'       => $this->email,
                'phone'       => $this->phone,
                'notes'       => $this->notes,
            ]);
        }

        // Vincular al alumno (representante_id en alumnos)
        $alumno = \App\Models\Alumno::findOrFail($this->selected_id);
        $alumno->representante_id = $rep->id;
        $alumno->save();

        // Guardamos el id para próximas ediciones
        $this->rep_id = $rep->id;

        $this->noty('Representante guardado con éxito.', 'noty', false);

        // avanzar a matrícula
        $this->tab = 'matri';
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
