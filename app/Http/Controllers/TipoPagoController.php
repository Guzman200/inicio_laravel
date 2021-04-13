<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\TipoPago;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TipoPagoController extends Controller
{
    
    public function index(Request $request)
    {

        if($request->ajax()){
            return DataTables::eloquent(TipoPago::query())->toJson();
        }

        return view('tipos_de_pago');
    }
}
