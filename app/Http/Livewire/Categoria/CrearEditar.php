<?php

namespace App\Http\Livewire\Categoria;

use App\Models\Categoria;
use Exception;
use Illuminate\Validation\Rule;
use Livewire\Component;

class CrearEditar extends Component
{

    public $categoria_id;
    public $codigo;
    public $nombre;

    protected $rules = [
        'codigo'       => 'required',
        'nombre'       => 'required'
    ];

    protected $messages = [];

    protected $listeners = ['editar', 'agregar', 'eliminar', 'storeUpdate'];

    public function render()
    {
        return view('livewire.categoria.crear-editar');
    }

    public function storeUpdate()
    {

        $this->validate($this->rules, $this->messages);

        $mensaje = "Categoría creada exitosamente.";

        if (is_null($this->categoria_id)) { // creación de una categoría

            $this->validate([
                'nombre' => 'unique:categorias',
                'codigo' => 'unique:categorias',
            ]);

            Categoria::create([
                'codigo'          => $this->codigo,
                'nombre'          => $this->nombre
            ]);

            $this->limpiarDatos();

        } else {

            $this->validate([
                'nombre'    => Rule::unique('categorias')->ignore($this->categoria_id),
                'codigo'    => Rule::unique('categorias')->ignore($this->categoria_id)
            ]);

            // Actualizamos
            $sucursal = Categoria::findOrFail($this->categoria_id);
            $sucursal->codigo    = $this->codigo;
            $sucursal->nombre    = $this->nombre;
            $sucursal->update();
            $mensaje = "Categoría actualizada exitosamente.";
            
        }

        session()->flash('message', $mensaje);

        $this->emit('actualizar_tabla');
    }

    public function limpiarDatos()
    {
        $this->codigo        = "";
        $this->nombre        = "";
        $this->categoria_id  = null;
    }

    public function editar($id)
    {
        $categoria = Categoria::find($id);

        // Limpiamos los errores de validacion en caso existan
        $this->resetErrorBag();
        $this->resetValidation();

        // Si el prducto existe
        if ($categoria) {
            
            $this->categoria_id  = $categoria->id;
            $this->codigo        = $categoria->codigo;
            $this->nombre        = $categoria->nombre;

            $this->emit('abrirModal');
        }
    }

    public function agregar()
    {
        $this->categoria_id = null;
        $this->limpiarDatos();

        // Limpiamos los errores de validacion en caso existan
        $this->resetErrorBag();
        $this->resetValidation();

        $this->emit('abrirModal');
    }

    public function eliminar($id)
    {
        $categoria = Categoria::find($id);

        // Si la categoría existe
        if ($categoria) {
            try {

                $categoria->delete();
                $this->emit('actualizar_tabla');
                $this->emit('sweetAlert', 'Eliminación exitosa.', '', 'success');

            } catch (Exception $e) {
                $this->emit('sweetAlert', 'Categoría no eliminada', '', 'error');
            }
        }
    }

    public function siguienteInputFocus($inputId)
    {
        $this->emit('siguienteInputFocus', $inputId);
    }


}
