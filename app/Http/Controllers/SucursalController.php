<?php

namespace App\Http\Controllers;

use App\Models\Sucursal;
use Illuminate\Http\Request;

class SucursalController extends Controller
{
    
    public function index(Request $request)
    {

        if($request->ajax()){
            return datatables()->eloquent(Sucursal::query())->toJson();
        }

        return view('sucursal.index');

    }
}
