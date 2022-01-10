<?php

namespace App\Http\Controllers\Catalogos;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){

            $query = Cliente::query();

            return datatables()->eloquent($query)
                ->rawColumns([])
                ->toJson();


        }

        return view('cliente.index');
    }
}
