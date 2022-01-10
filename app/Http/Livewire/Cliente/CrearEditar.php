<?php

namespace App\Http\Livewire\Cliente;

use App\Models\Cliente;
use Exception;
use Facade\FlareClient\Http\Client;
use Illuminate\Validation\Rule;
use Livewire\Component;

class CrearEditar extends Component
{

    public $cliente_id;
    public $nombre;
    public $email;
    public $telefono;
    public $direccion;
    public $fecha_nacimiento;
    
    protected $listeners = ['editar', 'agregar', 'eliminar', 'storeUpdate'];

    protected $rules = [
        'nombre' => 'required',
        'email' => 'nullable|email',
        'telefono' => ['sometimes', 'regex:/^[0-9]{10}$/'],
    ];

    protected $messages = [
        'telefono.regex'     => 'El télefono debe contener 10 digitos',
    ];

    public function render()
    {
        return view('livewire.cliente.crear-editar');
    }


    public function storeUpdate()
    {

        $this->validate($this->rules, $this->messages);

        $mensaje = "Cliente creado exitosamente.";

        if (is_null($this->cliente_id)) { // Creación de cliente

            $this->validate([
                'email' => 'unique:clientes',
                'telefono'       => 'sometimes|unique:clientes'
            ]);

            Cliente::create([
                'nombre'           => $this->nombre,
                'direccion'        => $this->direccion,
                'telefono'         => $this->telefono,
                'email'            => $this->email,
                'fecha_nacimiento' => $this->fecha_nacimiento,
            ]);

            $this->limpiarDatos();

        } else { // Modificación de cliente

            $this->validate([
                'email'    => Rule::unique('clientes')->ignore($this->cliente_id),
                'telefono'  => ['sometimes', Rule::unique('clientes')->ignore($this->cliente_id)]
            ]);

            // Actualizamos
            $cliente = Cliente::findOrFail($this->cliente_id);
            $cliente->nombre           = $this->nombre;
            $cliente->direccion        = $this->direccion;
            $cliente->telefono         = $this->telefono;
            $cliente->email            = $this->email;
            $cliente->fecha_nacimiento = $this->fecha_nacimiento;
            $cliente->update();
            $mensaje = "Cliente actualizado exitosamente.";
        }

        session()->flash('message', $mensaje);

        $this->emit('actualizar_tabla');
    }

    public function limpiarDatos()
    {
        $this->nombre           = "";
        $this->direccion        = "";
        $this->telefono         = "";
        $this->email            = "";
        $this->fecha_nacimiento = "";
    }

    public function editar($id)
    {
        $cliente = Cliente::find($id);

        

        // Limpiamos los errores de validacion en caso existan
        $this->resetErrorBag();
        $this->resetValidation();

        // Si el proveedor existe
        if ($cliente) {

            

            $this->cliente_id       = $cliente->id;
            $this->nombre           = $cliente->nombre;
            $this->direccion        = $cliente->direccion;
            $this->telefono         = $cliente->telefono;
            $this->email            = $cliente->email;
            $this->fecha_nacimiento = $cliente->fecha_nacimiento;

            $this->emit('abrirModal');
        }
    }

    public function agregar()
    {
        $this->cliente_id = null;
        $this->limpiarDatos();

        // Limpiamos los errores de validacion en caso existan
        $this->resetErrorBag();
        $this->resetValidation();

        $this->emit('abrirModal');
    }

    public function eliminar($id)
    {
        $cliente = Cliente::find($id);

        // Si el cliente existe
        if ($cliente) {
            try {

                $cliente->delete();
                $this->emit('actualizar_tabla');
                $this->emit('sweetAlert', 'Eliminación exitosa.', '', 'success');

            } catch (Exception $e) {
                $this->emit('sweetAlert', 'Cliente no eliminado', '', 'error');
            }
        }
    }

    public function siguienteInputFocus($inputId)
    {
        $this->emit('siguienteInputFocus', $inputId);
    }
}
