<?php

namespace App\Http\Controllers\Catalogos;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){

            $query = Categoria::select(['categorias.id', 'categorias.codigo','categorias.nombre']);

            return datatables()->eloquent($query)
                ->addColumn('productos', function(Categoria $categoria){ // stock del producto

                    return $categoria->productos->count();
                })
                ->rawColumns([])
                ->toJson();

        }

        return view('categoria.index');
    }
}
