<?php

namespace App\Http\Livewire\Proveedor;

use App\Models\Proveedor;
use App\Rules\Transportador\UpdatePhoneRule;
use Exception;
use Illuminate\Validation\Rule;
use Livewire\Component;

class CrearEditar extends Component
{

    public $proveedor_id;
    public $proveedor;
    public $rut;
    public $giro;
    public $direccion;
    public $telefono;
    public $contacto;

    protected $listeners = ['editar', 'agregar', 'eliminar', 'storeUpdate'];

    protected $rules = [
        'proveedor' => 'required',
        'direccion' => 'required',
        'telefono'  => ['required', 'regex:/^[0-9]{10}$/'],
        'contacto'  => 'required',
        'giro'      => 'required',
        'rut'       => 'required'
    ];

    protected $messages = [
        'telefono.regex'     => 'El télefono debe contener 10 digitos',
    ];

    public function render()
    {
        return view('livewire.proveedor.crear-editar');
    }

    public function storeUpdate()
    {

        $this->validate($this->rules, $this->messages);

        $mensaje = "Proveedor creado exitosamente.";

        if (is_null($this->proveedor_id)) {

            $this->validate([
                'proveedor' => 'unique:proveedores',
                'rut'          => 'unique:proveedores',
                'telefono'       => 'sometimes|unique:proveedores'
            ]);

            Proveedor::create([
                'proveedor' => $this->proveedor,
                'direccion' => $this->direccion,
                'telefono'  => $this->telefono,
                'contacto'  => $this->contacto,
                'giro'      => $this->giro,
                'rut'       => $this->rut
            ]);

            $this->limpiarDatos();
        } else {

            $this->validate([
                'proveedor'    => Rule::unique('proveedores')->ignore($this->proveedor_id),
                'rut'    => Rule::unique('proveedores')->ignore($this->proveedor_id),
                'telefono'  => ['sometimes', Rule::unique('proveedores')->ignore($this->proveedor_id)]
            ]);

            // Actualizamos
            $proveedor = Proveedor::findOrFail($this->proveedor_id);
            $proveedor->proveedor = $this->proveedor;
            $proveedor->direccion = $this->direccion;
            $proveedor->telefono  = $this->telefono;
            $proveedor->contacto  = $this->contacto;
            $proveedor->giro      = $this->giro;
            $proveedor->rut       = $this->rut;
            $proveedor->update();
            $mensaje = "Proveedor actualizado exitosamente.";
        }

        session()->flash('message', $mensaje);

        $this->emit('actualizar_tabla');
    }

    public function limpiarDatos()
    {
        $this->proveedor   = "";
        $this->direccion   = "";
        $this->telefono    = "";
        $this->contacto    = "";
        $this->giro        = "";
        $this->rut         = "";
    }

    public function editar($id)
    {
        $proveedor = Proveedor::find($id);

        

        // Limpiamos los errores de validacion en caso existan
        $this->resetErrorBag();
        $this->resetValidation();

        // Si el proveedor existe
        if ($proveedor) {

            

            $this->proveedor_id  = $proveedor->id;
            $this->proveedor = $proveedor->proveedor;
            $this->direccion = $proveedor->direccion;
            $this->telefono  = $proveedor->telefono;
            $this->contacto  = $proveedor->contacto;
            $this->giro      = $proveedor->giro;
            $this->rut       = $proveedor->rut;

            $this->emit('abrirModal');
        }
    }

    public function agregar()
    {
        $this->proveedor_id = null;
        $this->limpiarDatos();

        // Limpiamos los errores de validacion en caso existan
        $this->resetErrorBag();
        $this->resetValidation();

        $this->emit('abrirModal');
    }

    public function eliminar($id)
    {
        $proveedor = Proveedor::find($id);

        // Si el transportador existe
        if ($proveedor) {
            try {

                $proveedor->delete();
                $this->emit('actualizar_tabla');
                $this->emit('sweetAlert', 'Eliminación exitosa.', '', 'success');

            } catch (Exception $e) {
                $this->emit('sweetAlert', 'Proveedor no eliminado', '', 'error');
            }
        }
    }
}