<?php

namespace App\Http\Livewire\Transportador;

use App\Models\Transportador;
use Livewire\Component;

class CrearEditar extends Component
{

    public $transportador_id;
    public $nombres;
    public $apellidos;
    public $telefono;
    public $correo;

    protected $listeners = ['editar', 'agregar', 'eliminar', 'storeUpdate'];

    protected $rules = [
        'nombres'   => 'required',
        'apellidos' => 'required',
        'telefono'  => 'required',
        'correo'    => 'required|email'
    ];

    protected $messages = [
        'nombres.required'   => 'Es requerido',
        'apellidos.required' => 'Es requerido',
        'telefono.required'  => 'Es requerido',
        'correo.required'    => 'Es requerido'
    ];

    public function render()
    {
        return view('livewire.transportador.crear-editar');
    }

    public function storeUpdate()
    {

        sleep(5);
        
        $this->validate($this->rules,$this->messages);
        
        $mensaje = "Transportador creado exitosamente.";

        if(is_null($this->transportador_id)){
           
            Transportador::create([
                'nombres'   => $this->nombres,
                'apellidos' => $this->apellidos,
                'telefono'  => $this->telefono,
                'correo'    => $this->correo
            ]);

            $this->limpiarDatos();

        }else{
            // Actualizamos
            $transportador = Transportador::findOrFail($this->transportador_id);
            $transportador->nombres   = $this->nombres;
            $transportador->apellidos = $this->apellidos;
            $transportador->telefono  = $this->telefono;
            $transportador->correo    = $this->correo;
            $transportador->update();
            $mensaje = "Transportador actualizado exitosamente.";
        }

        session()->flash('message', $mensaje);

        $this->emit('actualizar_tabla');
        
    }

    public function limpiarDatos()
    {
        $this->nombres   = "";
        $this->apellidos = "";
        $this->telefono  = "";
        $this->correo    = "";
    }

    public function editar($id)
    {
        $transportador = Transportador::find($id);

        // Limpiamos los errores de validacion en caso existan
        $this->resetErrorBag();
        $this->resetValidation();

        // Si el transportador existe
        if($transportador){

            $this->transportador_id = $id;
            $this->nombres          = $transportador->nombres;
            $this->apellidos        = $transportador->apellidos;
            $this->telefono         = $transportador->telefono;
            $this->correo           = $transportador->correo;

            $this->emit('abrirModal');
        }
    }

    public function agregar()
    {
        $this->transportador_id = null;
        $this->limpiarDatos();

        // Limpiamos los errores de validacion en caso existan
        $this->resetErrorBag();
        $this->resetValidation();

        $this->emit('abrirModal');
    }

    public function eliminar($id)
    {
        $transportador = Transportador::find($id);

        // Si el transportador existe
        if($transportador){
           $transportador->delete();
           $this->emit('actualizar_tabla');
           $this->emit('sweetAlert','Eliminación exitosa.','','success');
        }
        
    }
}
