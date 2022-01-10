<?php

namespace App\Http\Livewire\Venta;

use App\Models\Cliente;
use App\Models\TipoVenta;
use Livewire\Component;

class CrearVenta extends Component
{
    public function render()
    {
        $tipo_ventas = TipoVenta::get();
        $clientes    = Cliente::get();
        return view('livewire.venta.crear-venta', compact('tipo_ventas', 'clientes'));
    }
}
