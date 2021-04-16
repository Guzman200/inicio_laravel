<?php

namespace App\Http\Livewire\OrdenCompra;

use App\Models\OrdenCompra;
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
}
