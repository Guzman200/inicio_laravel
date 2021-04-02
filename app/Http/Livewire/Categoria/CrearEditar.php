<?php

namespace App\Http\Livewire\Categoria;

use App\Models\Categoria;
use Livewire\Component;

class CrearEditar extends Component
{

    public $categoria_id;
    public $descripcion;

    protected $listeners = ['editar', 'agregar', 'eliminar', 'storeUpdate'];

    protected $rules = [
        'descripcion'   => 'required'
    ];

    protected $messages = [
        'descripcion.required'   => 'Es requerido'
    ];

    public function render()
    {
        return view('livewire.categoria.crear-editar');
    }

    public function storeUpdate()
    {
        
        $this->validate($this->rules,$this->messages);
        
        $mensaje = "Categoría creada exitosamente.";

        if(is_null($this->categoria_id)){
            // Creamos
            Categoria::create([
                'descripcion'   => $this->descripcion
            ]);

            $this->limpiarDatos();

        }else{
            // Actualizamos
            $categoria = Categoria::findOrFail($this->categoria_id);
            $categoria->descripcion   = $this->descripcion;
            $categoria->update();
            $mensaje = "Categoría actualizada exitosamente.";
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
        $categoria = Categoria::find($id);

        // Si la categoría existe
        if($categoria){

            $this->categoria_id = $id;
            $this->descripcion  = $categoria->descripcion;
            $this->emit('abrirModal');
        }
    }

    public function agregar()
    {
        $this->categoria_id = null;
        $this->limpiarDatos();

        $this->emit('abrirModal');
    }

    public function eliminar($id)
    {
        $categoria = Categoria::find($id);

        // Si la categorái existe
        if($categoria){
           $categoria->delete();
           $this->emit('actualizar_tabla');
           $this->emit('sweetAlert','Eliminación exitosa.','','success');
        }
        
    }
}
