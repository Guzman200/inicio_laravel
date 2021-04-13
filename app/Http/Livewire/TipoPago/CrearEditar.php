<?php

namespace App\Http\Livewire\TipoPago;

use App\Models\TipoPago;
use Exception;
use Illuminate\Validation\Rule;
use Livewire\Component;

class CrearEditar extends Component
{

    public $tipo_pago_id;
    public $descripcion;

    protected $listeners = ['editar', 'agregar', 'eliminar', 'storeUpdate'];

    protected $rules = [
        'descripcion'   => 'required'
    ];

    protected $messages = [
        'descripcion.required'   => 'Es requerido'
    ];

    protected $validationAttributes = [
        'descripcion' => 'forma de pago'
    ];

    public function render()
    {
        return view('livewire.tipo-pago.crear-editar');
    }

    public function storeUpdate()
    {

        $this->validate($this->rules, $this->messages);

        $mensaje = "Forma de pago creada exitosamente.";

        if (is_null($this->tipo_pago_id)) {


            $this->validate([
                'descripcion' => Rule::unique('tipos_de_pago')->ignore($this->tipo_pago_id)
            ]);

            // Creamos
            TipoPago::create([
                'descripcion'   => $this->descripcion
            ]);

            $this->limpiarDatos();
        } else {
            // Actualizamos
            $tipo = TipoPago::findOrFail($this->tipo_pago_id);
            $tipo->descripcion   = $this->descripcion;
            $tipo->update();
            $mensaje = "Forma de pago actualizada exitosamente.";
        }

        session()->flash('message', $mensaje);

        $this->emit('actualizar_tabla');
    }

    public function limpiarDatos()
    {
        $this->descripcion   = "";
    }

    public function editar($id)
    {
        $tipo = TipoPago::find($id);

        // Si el tipo de pago existe
        if ($tipo) {

            $this->tipo_pago_id = $id;
            $this->descripcion  = $tipo->descripcion;
            $this->emit('abrirModal');
        }
    }

    public function agregar()
    {
        $this->tipo_pago_id = null;
        $this->limpiarDatos();

        $this->emit('abrirModal');
    }

    public function eliminar($id)
    {
        $tipo = TipoPago::find($id);

        // Si el tipo de pago existe
        if ($tipo) {
            try {

                $tipo->delete();
                $this->emit('actualizar_tabla');
                $this->emit('sweetAlert', 'Eliminación exitosa.', '', 'success');

            } catch (Exception $e) {
                $this->emit('sweetAlert', 'Forma de pago no eliminada', '', 'error');
            }
        }
    }
}
