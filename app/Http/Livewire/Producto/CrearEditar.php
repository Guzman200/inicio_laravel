<?php

namespace App\Http\Livewire\Producto;

use App\Models\Categoria;
use App\Models\Producto;
use Exception;
use Livewire\Component;

class CrearEditar extends Component
{
    public $producto_id;
    public $codigo;
    public $nombre;
    public $quiebre_stock;
    public $categoria_id;
    public $precio_venta;

    protected $rules = [
        'codigo' => 'required',
        'nombre'      => 'required',
        'categoria_id' => 'required',
        'quiebre_stock'  => ['required', 'numeric','min:1'],
        'precio_venta'  => 'required|numeric'
    ];

    protected $messages = [
        'categoria_id.required'     => 'El campo categoría es requerido.',
    ];

    protected $listeners = ['editar', 'agregar', 'eliminar', 'storeUpdate'];

    public function render()
    {
        $categorias = Categoria::orderBy('nombre')->get();
        return view('livewire.producto.crear-editar', compact('categorias'));
    }

    public function storeUpdate()
    {

        $this->validate($this->rules, $this->messages);

        $mensaje = "Producto creado exitosamente.";

        if (is_null($this->producto_id)) { // creación de un producto

            $this->validate([
                'nombre' => 'unique:productos',
                'codigo' => 'unique:productos',
            ]);

            Producto::create([
                'codigo'          => $this->codigo,
                'nombre'          => $this->nombre,
                'precio_venta'    => $this->precio_venta,
                'quiebre_stock'   => $this->quiebre_stock,
                'categoria_id'    => $this->categoria_id,
                'stock_en_dinero' => 0,
                'stock' => 0
            ]);

            $this->limpiarDatos();

        } else {

            /*$this->validate([
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
            */
        }

        session()->flash('message', $mensaje);

        $this->emit('actualizar_tabla');
    }

    public function limpiarDatos()
    {
        $this->codigo        = "";
        $this->nombre        = "";
        $this->categoria_id  = "";
        $this->quiebre_stock = "";
        $this->precio_venta  = "";
    }

    public function editar($id)
    {
        $producto = Producto::find($id);

        // Limpiamos los errores de validacion en caso existan
        $this->resetErrorBag();
        $this->resetValidation();

        // Si el prducto existe
        if ($producto) {
            
            $this->producto_id   = $producto->id;
            $this->codigo        = $producto->codigo;
            $this->nombre        = $producto->nombre;
            $this->quiebre_stock = $producto->quiebre_stock;
            $this->precio_venta  = $producto->precio_venta;
            $this->categoria_id  = $producto->categoria_id;

            $this->emit('abrirModal');
        }
    }

    public function agregar()
    {
        $this->producto_id = null;
        $this->limpiarDatos();

        // Limpiamos los errores de validacion en caso existan
        $this->resetErrorBag();
        $this->resetValidation();

        $this->emit('abrirModal');
    }

    public function eliminar($id)
    {
        $producto = Producto::find($id);

        // Si el producto existe
        if ($producto) {
            try {

                $producto->delete();
                $this->emit('actualizar_tabla');
                $this->emit('sweetAlert', 'Eliminación exitosa.', '', 'success');

            } catch (Exception $e) {
                $this->emit('sweetAlert', 'Producto no eliminado', '', 'error');
            }
        }
    }

    public function siguienteInputFocus($inputId)
    {
        $this->emit('siguienteInputFocus', $inputId);
    }
}
