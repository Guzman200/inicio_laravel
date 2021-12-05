<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    
    public function index(Request $request)
    {
        if($request->ajax()){

            $query = Producto::select(['productos.id', 'codigo', 'productos.nombre', 'stock', 'precio_venta', 'stock_en_dinero', 'quiebre_stock','categoria_id'])
                        ->with(['categoria']);

            return datatables()->eloquent($query)
                ->addColumn('stock_render', function(Producto $producto){ // stock del producto

                    $color = "success";
                    $stock = $producto->stock;

                    if($producto->stock <= $producto->quiebre_stock){
                        $color = "danger";
                    }

                    return "<button type='button' class='btn btn-$color btn-sm'>$stock</button>";
                })
                ->addColumn('stock_en_dinero_render', function(Producto $producto){
                    return '$' . number_format($producto->stock_en_dinero, 2);
                })
                ->addColumn('precio_venta_render', function(Producto $producto){
                    return '$' . number_format($producto->precio_venta, 2);
                })
                ->rawColumns(['stock_render', 'stock_en_dinero_render','precio_venta_render'])
                ->toJson();

        }

        return view('producto.index');
    }
}
