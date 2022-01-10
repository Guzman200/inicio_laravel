<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CrearVentaController extends Controller
{
    public function index(Request $request)
    {
        return view('venta.index');
    }
}
