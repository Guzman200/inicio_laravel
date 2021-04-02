<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoriaController extends Controller
{
    
    public function index(Request $request)
    {

        if($request->ajax()){
            return DataTables::eloquent(Categoria::query())->toJson();
        }

        return view('categorias');
    }
}
