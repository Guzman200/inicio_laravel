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

        return view('home', compact('pagos_pendientes','proveedores','ordenes','usuarios'));
    }

    public function formato()
    {

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('formato');
        //$pdf->loadHTML('<h1>Test</h1>');
        return $pdf->stream();

        return view('formato');
    }
}
