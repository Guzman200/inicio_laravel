<?php

namespace App\Http\Controllers;

use App\Models\OrdenCompra;
use App\Models\Pago;
use App\Models\Proveedor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $pagos_pendientes = Pago::where('status', 'por pagar')->count();
        $proveedores      = Proveedor::count();
        $ordenes          = OrdenCompra::count();
        $usuarios         = User::where('status',true)->count();

        // Obtenemos las ultimas ordenes de compra
        $ordenes_compra = OrdenCompra::latest()->take(10)->get();

        return view('home', compact('pagos_pendientes','proveedores','ordenes','usuarios','ordenes_compra'));
    }

    
}
