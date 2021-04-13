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
    public $nombre;
    public $direccion;
    public $telefono;
    public $correo;

    protected $listeners = ['editar', 'agregar', 'eliminar', 'storeUpdate'];

    protected $rules = [
        'nombre'   => 'required',
        'direccion' => 'required',
        'telefono'  => ['required', 'regex:/^[0-9]{10}$/'],
        'correo'    => 'required|email'
    ];

    protected $messages = [
        'nombre.required'    => 'Es requerido',
        'direccion.required' => 'Es requerido',
        'telefono.required'  => 'Es requerido',
        'telefono.regex'     => 'El télefono debe contener 10 digitos',
        'correo.required'    => 'Es requerido'
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
                'nombre' => 'unique:proveedores',
                'correo'          => 'unique:proveedores',
                'telefono'       => 'sometimes|unique:proveedores'
            ]);

            Proveedor::create([
                'nombre'    => $this->nombre,
                'direccion' => $this->direccion,
                'telefono'  => $this->telefono,
                'correo'    => $this->correo
            ]);

            $this->limpiarDatos();
        } else {

            $this->validate([
                'nombre'    => Rule::unique('proveedores')->ignore($this->proveedor_id),
                'correo'    => Rule::unique('proveedores')->ignore($this->proveedor_id),
                'telefono'  => ['sometimes', Rule::unique('proveedores')->ignore($this->proveedor_id)]
            ]);

            // Actualizamos
            $proveedor = Proveedor::findOrFail($this->proveedor_id);
            $proveedor->nombre   = $this->nombre;
            $proveedor->direccion = $this->direccion;
            $proveedor->telefono  = $this->telefono;
            $proveedor->correo    = $this->correo;
            $proveedor->update();
            $mensaje = "Proveedor actualizado exitosamente.";
        }

        session()->flash('message', $mensaje);

        $this->emit('actualizar_tabla');
    }

    public function limpiarDatos()
    {
        $this->nombre    = "";
        $this->direccion = "";
        $this->telefono  = "";
        $this->correo    = "";
    }

    public function editar($id)
    {
        $proveedor = Proveedor::find($id);

        // Limpiamos los errores de validacion en caso existan
        $this->resetErrorBag();
        $this->resetValidation();

        // Si el proveedor existe
        if ($proveedor) {

            $this->proveedor_id     = $id;
            $this->nombre           = $proveedor->nombre;
            $this->direccion        = $proveedor->direccion;
            $this->telefono         = $proveedor->telefono;
            $this->correo           = $proveedor->correo;

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
                $this->emit('sweetAlert', 'Proveedor de pago no eliminada', '', 'error');
            }
        }
    }
}




// num 
// 5256 7831 2865 9795
// banamex 
