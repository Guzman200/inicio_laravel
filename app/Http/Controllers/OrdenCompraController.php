<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\OrdenCompra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SebastianBergmann\Timer\Timer;

class OrdenCompraController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $ordenes = OrdenCompra::select([
                'id', 'proyecto', 'centro_costo', 'cotizacion', 'num_pagos', 'num_facturas', 'total'
            ]);

            return datatables()->eloquent($ordenes)
                ->addColumn('barra_pago', function (OrdenCompra $orden) {

                    $num_pagados = $orden->getNumeroPagosPagados();

                    $porcentaje = ($num_pagados * 100) / $orden->num_pagos;

                    $bg = "";

                    if($porcentaje == 100){
                        $bg = "bg-success";
                    }
 
                    return "<div class='progress' style='height: 20px;'>
                                <div class='progress-bar $bg' role='progressbar' style='width: $porcentaje%;' aria-valuemin='0' aria-valuemax='100'>$num_pagados</div>
                            </div>
                            "; 
                    
                    
                })->addColumn('pagos_pagados', function(OrdenCompra $orden){
                    return $orden->getNumeroPagosPagados();
                })
                ->rawColumns(['barra_pago'])
                ->toJson();
        }

        return view('ordenes_de_compra');
    }

    public function subirFacturas(Request $request, OrdenCompra $orden)
    {
        return view("subir_facturas", compact("orden"));
    }

    public function subirFacturasPOST(Request $request, OrdenCompra $orden)
    {
        if($request->hasFile("file")){


            $facturaPDF = $request->file("file");

            $nombreArchivo = $facturaPDF->getClientOriginalName();

            $ruta = storage_path("app/public/ordenes_de_compra/$orden->id");

            $facturaPDF->move($ruta, $nombreArchivo);

            Factura::create([
                'direccion_factura' => $ruta . "/" . $nombreArchivo,
                'ordenes_de_compra_id' => $orden->id
            ]);

        }
    }
}
