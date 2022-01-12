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

    protected $listeners = ['updateCantidad','updateDescuento'];

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
            'total'    => ($cantidad * $precio), // con descuento,
            'total_sin_descuento' => ($cantidad * $precio),
            'descuento' => 0, // %
            'descuento_en_pesos' => 0
        ];
        
    }

    /**
     * @param $index key del array
     */
    public function eliminarProducto($index)
    {
        unset($this->productosAgregados[$index]);
    }

    /**
     * Modificar la cantidad del producto
     * 
     * @param $index key del array
     */
    public function updateCantidad($index, $cantidad){

        $this->productosAgregados[$index]['cantidad'] = (int) $cantidad;
        $this->productosAgregados[$index]['total'] = (int) $cantidad * $this->productosAgregados[$index]['precio'];

        $descuento = $this->productosAgregados[$index]['descuento'];
        $this->updateDescuento($index, $descuento);
    }

    /**
     * Modificar el descuento del producto
     * 
     * @param $index key del array
     */
    public function updateDescuento($index, $descuento){

        $this->productosAgregados[$index]['total'] = $this->productosAgregados[$index]['cantidad'] * $this->productosAgregados[$index]['precio'];
        $this->productosAgregados[$index]['total_sin_descuento'] = $this->productosAgregados[$index]['total'];

        $this->productosAgregados[$index]['descuento'] = (int) $descuento; // en %
        $descuento = $this->productosAgregados[$index]['total'] * ($descuento / 100); // en pesos
        $this->productosAgregados[$index]['total'] = $this->productosAgregados[$index]['total'] - $descuento;
        $this->productosAgregados[$index]['descuento_en_pesos'] = $descuento;
    }


}
