<?php

namespace App\Http\Livewire\Material;

use App\Models\Categoria;
use App\Models\Material;
use Livewire\Component;

class CrearEditar extends Component
{
   
    public $material_id;
    public $nombre;
    public $categoria_id;
    public $acabado;
    public $cantidad;

    protected $listeners = ['editar', 'agregar', 'eliminar', 'storeUpdate'];

    protected $rules = [
        'nombre'       => 'required',
        'categoria_id' => 'required',
        'acabado'      => 'required',
        'cantidad'     => 'required'
    ];

    protected $messages = [
        'nombre.required'       => 'Es requerido',
        'categoria_id.required' => 'Es requerido',
        'acabado.required'      => 'Es requerido',
        'cantidad.required'     => 'Es requerido'
    ];

    public function render()
    {

        $categorias = Categoria::get();

        return view('livewire.material.crear-editar',compact('categorias'));
    }

    public function storeUpdate()
    {
       
        $this->validate($this->rules,$this->messages);
        
        $mensaje = "Material creado exitosamente.";

        if(is_null($this->material_id)){
           
            Material::create([
                'nombre'       => $this->nombre,
                'categoria_id' => $this->categoria_id,
                'acabado'      => $this->acabado,
                'cantidad'    => $this->cantidad
            ]);
            

            $this->limpiarDatos();

        }else{
            // Actualizamos
            $material = Material::findOrFail($this->material_id);
            $material->nombre       = $this->nombre;
            $material->categoria_id = $this->categoria_id;
            $material->acabado      = $this->acabado;
            $material->cantidad     = $this->cantidad;
            $material->update();
            $mensaje = "Material actualizado exitosamente.";
        }

        session()->flash('message', $mensaje);

        $this->emit('actualizar_tabla');
        
    }

    public function limpiarDatos()
    {
        $this->nombre       = "";
        $this->categoria_id = "";
        $this->acabado      = "";
        $this->cantidad     = "";
    }

    public function editar($id)
    {
        $material = Material::find($id);

        // Si el material existe
        if($material){

             // Reseteamos los errores validación
            $this->resetErrorBag();
            $this->resetValidation();


            $this->material_id   = $id;
            $this->nombre        = $material->nombre;
            $this->categoria_id  = $material->categoria_id;
            $this->acabado       = $material->acabado;
            $this->cantidad      = $material->cantidad;

            $this->emit('abrirModal');
        }
    }

    public function agregar()
    {
        $this->material_id = null;
        $this->limpiarDatos();

        // Reseteamos los errores validación
        $this->resetErrorBag();
        $this->resetValidation();

        $this->emit('abrirModal');
    }

    public function eliminar($id)
    {
        $material = Material::find($id);

        // Si el material existe
        if($material){
           $material->delete();
           $this->emit('loaderOut');
           $this->emit('actualizar_tabla');
           $this->emit('sweetAlert','Eliminación exitosa.','','success');
        }
        
    }
}
