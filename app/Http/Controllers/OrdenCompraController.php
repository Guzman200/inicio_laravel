<?php

namespace App\Http\Controllers;

use App\Models\OrdenCompra;
use Illuminate\Http\Request;

class OrdenCompraController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
           
            return datatables()->eloquent(OrdenCompra::query())->toJson();
        }

        return view('ordenes_de_compra');
    }
}
