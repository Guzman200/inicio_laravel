<?php

namespace App\Http\Livewire\Venta;

use App\Models\Cliente;
use App\Models\Producto;
use App\Models\TipoVenta;
use Livewire\Component;

class CrearVenta extends Component
{

    public $arrayProductos = []; // los productos que coniciden con la busqueda
    public $search = "";
    public $productosAgregados = []; // Los productos agregados a la compra

    public function render()
    {
        $tipo_ventas = TipoVenta::get();
        $clientes    = Cliente::get();

        if($this->search != "" && !is_null($this->search)){
            $this->arrayProductos = Producto::where('nombre', 'like', "%{$this->search}%")
                ->orWhere('codigo', 'like', "%{$this->search}%")->take(5)->get()->toArray();
        }else{
            $this->arrayProductos = [];
        }

        return view('livewire.venta.crear-venta', compact('tipo_ventas', 'clientes'));
    }

    public function agregarProducto($codigo, $nombre, $precio, $cantidad)
    {
        $this->productosAgregados[] = [
            'codigo'   => $codigo,
            'nombre'   => $nombre,
            'precio'   => $precio,
            'cantidad' => $cantidad,
            'total'    => ($cantidad * $precio)
        ];
    }

    /**
     * @param $index key del array
     */
    public function eliminarProducto($index)
    {
        unset($this->productosAgregados[$index]);
    }


}
