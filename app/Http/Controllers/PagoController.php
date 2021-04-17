<?php

namespace App\Http\Controllers;

use App\Models\OrdenCompra;
use App\Models\Pago;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PagoController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $pago = Pago::select([
                'pagos.id', 'pagos.fecha_en_que_se_pago', 'pagos.status', 'pagos.cantidad',
                'pagos.fecha',
                'pagos.ordenes_de_compra_id', 'pagos.tipos_de_pago_id'
            ])->with(['tipoDePago','ordenDeCompra']);

            return DataTables::eloquent($pago)
                ->editColumn('fecha_en_que_se_pago', function (Pago $pago) {

                    if(is_null($pago->fecha_en_que_se_pago)){
                        return "Pendiente en pagar";
                    }
                    return $pago->fecha_en_que_se_pago->format('d-m-Y');
                })
                ->editColumn('fecha', function (Pago $pago) {

                    return $pago->fecha->format("d-m-Y");
                })
                ->editColumn('status', function (Pago $pago) {

                    if ($pago->status == "por pagar") {

                        $fecha = new Carbon($pago->fecha);

                        // Si la fecha del pago es mayor a la actual (es decir el pago ya vencio)
                        if ($fecha->gte(Carbon::now())) {
                            return '<span class="badge badge-warning">Por pagar</span>';
                        }
                        return '<span class="badge badge-danger">Por pagar</span>';
                    }

                    return '<span class="badge badge-success">Pagado</span>';
                })
                ->filterColumn('fecha', function ($query, $keyword) {
                    // Para que el usuario pueda buscar por formato dia-mes-año
                    $sql = "DATE_FORMAT(pagos.fecha, '%d-%m-%Y') like ? or DATE_FORMAT(pagos.fecha_en_que_se_pago, '%d-%m-%Y') like ?";
                    $query->whereRaw($sql, ["%{$keyword}%","%{$keyword}%"]);
                }) 
                ->rawColumns(['status'])
                ->toJson();
        }

        return view('pagos');
    }

    public function cambiarStatusAPagado(Pago $pago)
    {

        $pago->status = "pagado";
        $pago->fecha_en_que_se_pago = Carbon::now();
        $pago->update();

        $ordenCompra = OrdenCompra::findOrFail($pago->ordenes_de_compra_id);

        if($ordenCompra->getNumeroPagosPagados() == $ordenCompra->num_pagos){
            $ordenCompra->status = "pagada";
            $ordenCompra->update();
        }

        return response()->json(["mensaje" => "estatus cambiado"],201);
    }
}
