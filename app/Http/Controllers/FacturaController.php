<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use Illuminate\Http\Request;

class FacturaController extends Controller
{
    public function descargarFactura(Request $request, Factura $factura)
    {
        return response()->download($factura->direccion_factura, 'factura.pdf');
    }

}
