<?php

namespace App\Services\OrdenCompra;

use App\DTOs\DetalleOrdenCompraDTO;
use App\Models\DetalleOrdenCompra;
use App\Models\OrdenCompra;
use Illuminate\Support\Facades\Hash;

class CrearOrdenCompra
{
    private $id;
    private $num_pagos;
    private $num_facturas;
    private $centro_costo;
    private $cotizacion;
    private $proyecto;
    private $total;
    private $total_neto;
    private $subtotal;
    private $descuento;
    private $iva_id;
    private $proveedor_id;
    private $user_id;
    private $observaciones;
    private const STATUS = "por pagar";

    public function __construct(
        $num_pagos,
        $num_facturas,
        $centro_costo,
        $cotizacion,
        $proyecto,
        $total,
        $total_neto,
        $subtotal,
        $descuento,
        $iva_id,
        $proveedor_id,
        $user_id,
        $observaciones
    ) {
        $this->num_pagos      = $num_pagos;
        $this->num_facturas   = $num_facturas;
        $this->centro_costo   = $centro_costo;
        $this->cotizacion     = $cotizacion;
        $this->proyecto       = $proyecto;
        $this->total          = $total;
        $this->total_neto     = $total_neto;
        $this->subtotal       = $subtotal;
        $this->descuento      = $descuento;
        $this->iva_id         = $iva_id;
        $this->proveedor_id   = $proveedor_id;
        $this->user_id        = $user_id;
        $this->observaciones  = $observaciones;
    }

    public function crear()
    {

        $orden = OrdenCompra::create([
            'num_pagos'       => $this->num_pagos,
            'num_facturas'    => $this->num_facturas,
            'centro_costo'    => $this->centro_costo,
            'cotizacion'      => $this->cotizacion,
            'proyecto'        => $this->proyecto,
            'total'           => $this->total,
            'total_neto'      => $this->total_neto,
            'subtotal'        => $this->subtotal,
            'descuento'       => $this->descuento,
            'iva_id'          => $this->iva_id,
            'proveedores_id'  => $this->proveedor_id,
            'user_id'         => $this->user_id,
            'observaciones'   => $this->observaciones,
            'status'          => self::STATUS
        ]);

        $this->id = $orden->id;

        return $orden;
    }

    public function crearDetalle($descripcion, $unidad, $cantidad, $valor_unitario)
    {
        $detalle = DetalleOrdenCompra::create([
            'descripcion'          => $descripcion,
            'unidad'               => $unidad,
            'cantidad'             => $cantidad,
            'valor_unitario'       => $valor_unitario,
            'ordenes_de_compra_id' => $this->id
        ]);

        return $detalle;
    }
}
