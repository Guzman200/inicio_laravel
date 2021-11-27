<?php

namespace App\Http\Livewire\Sucursal;

use App\Models\Sucursal;
use Exception;
use Illuminate\Validation\Rule;
use Livewire\Component;

class CrearEditar extends Component
{

    public $sucursal_id;
    public $codigo;
    public $nombre;
    public $telefono;
    public $email;
    public $direccion;

    protected $rules = [
        'codigo' => 'required',
        'direccion' => 'required',
        'telefono'  => ['nullable', 'regex:/^[0-9]{10}$/'],
        'email'  => 'required',
        'nombre'      => 'required'
    ];

    protected $messages = [
        'telefono.regex'     => 'El télefono debe contener 10 digitos',
    ];

    protected $listeners = ['editar', 'agregar', 'eliminar', 'storeUpdate'];

    public function render()
    {
        return view('livewire.sucursal.crear-editar');
    }

    public function storeUpdate()
    {

        $this->validate($this->rules, $this->messages);

        $mensaje = "Sucursal creada exitosamente.";

        if (is_null($this->sucursal_id)) {

            $this->validate([
                'email' => 'unique:sucursales',
                'codigo'          => 'unique:sucursales',
                'telefono'       => 'sometimes|unique:sucursales'
            ]);

            Sucursal::create([
                'codigo'    => $this->codigo,
                'nombre'    => $this->nombre,
                'direccion' => $this->direccion,
                'email'     => $this->email,
                'telefono'  => $this->telefono,
            ]);

            $this->limpiarDatos();

        } else {

            $this->validate([
                'email'    => Rule::unique('sucursales')->ignore($this->sucursal_id),
                'codigo'    => Rule::unique('sucursales')->ignore($this->sucursal_id),
                'telefono'  => ['sometimes', Rule::unique('sucursales')->ignore($this->sucursal_id)]
            ]);

            // Actualizamos
            $sucursal = Sucursal::findOrFail($this->sucursal_id);
            $sucursal->codigo    = $this->codigo;
            $sucursal->nombre    = $this->nombre;
            $sucursal->telefono  = $this->telefono;
            $sucursal->email     = $this->email;
            $sucursal->direccion = $this->direccion;
            $sucursal->update();
            $mensaje = "Sucursal actualizada exitosamente.";
        }

        session()->flash('message', $mensaje);

        $this->emit('actualizar_tabla');
    }

    public function limpiarDatos()
    {
        $this->codigo    = "";
        $this->nombre    = "";
        $this->telefono  = "";
        $this->email     = "";
        $this->direccion = "";
    }

    public function editar($id)
    {
        $sucursal = Sucursal::find($id);

        // Limpiamos los errores de validacion en caso existan
        $this->resetErrorBag();
        $this->resetValidation();

        // Si la sucursal existe
        if ($sucursal) {
            
            $this->sucursal_id  = $sucursal->id;
            $this->codigo       = $sucursal->codigo;
            $this->nombre       = $sucursal->nombre;
            $this->telefono     = $sucursal->telefono;
            $this->email        = $sucursal->email;
            $this->direccion    = $sucursal->direccion;

            $this->emit('abrirModal');
        }
    }

    public function agregar()
    {
        $this->sucursal_id = null;
        $this->limpiarDatos();

        // Limpiamos los errores de validacion en caso existan
        $this->resetErrorBag();
        $this->resetValidation();

        $this->emit('abrirModal');
    }

    public function eliminar($id)
    {
        $sucursal = Sucursal::find($id);

        // Si la sucursal existe
        if ($sucursal) {
            try {

                $sucursal->delete();
                $this->emit('actualizar_tabla');
                $this->emit('sweetAlert', 'Eliminación exitosa.', '', 'success');

            } catch (Exception $e) {
                $this->emit('sweetAlert', 'Sucursal no eliminada', '', 'error');
            }
        }
    }

    public function siguienteInputFocus($inputId)
    {
        $this->emit('siguienteInputFocus', $inputId);
    }
}
