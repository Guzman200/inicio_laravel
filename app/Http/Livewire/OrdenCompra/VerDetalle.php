<?php

namespace App\Http\Livewire\OrdenCompra;

use App\Models\Factura;
use App\Models\OrdenCompra;
use Carbon\Carbon;
use Livewire\Component;

class VerDetalle extends Component
{

    protected $listeners = ['verDetalleOrden'];

    public $orden_id;

    public function render()
    {
        $orden = OrdenCompra::find($this->orden_id);

        return view('livewire.orden-compra.ver-detalle', ['orden' => $orden]);
    }

    public function verDetalleOrden($id){
        
        $this->orden_id = $id;
        $this->emit( 'abrirModalDetalle');
    }

    public function eliminarFactura($id)
    {
        $factura = Factura::find($id);

        if($factura)
        {
            unlink($factura->direccion_factura);
            $factura->delete();
        }
    }
}
