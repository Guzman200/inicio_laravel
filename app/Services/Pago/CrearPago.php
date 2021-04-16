<?php

namespace App\Services\Pago;

use App\Models\Pago;

class CrearPago
{

    private $fecha;
    private $cantidad;
    private const STATUS = "por pagar";
    private $ordenes_de_compra_id;
    private $tipos_pago_id;

    public function __construct(
        $fecha,
        $cantidad,
        $ordenes_de_compra_id,
        $tipos_pago_id
    ) {
        $this->fecha                = $fecha;
        $this->cantidad             = $cantidad;
        $this->ordenes_de_compra_id = $ordenes_de_compra_id;
        $this->tipos_pago_id        = $tipos_pago_id;
    }

    public function crear()
    {
        $pago = Pago::create([
            'fecha'                => $this->fecha,
            'cantidad'             => $this->cantidad,
            'status'               => self::STATUS,
            'ordenes_de_compra_id' => $this->ordenes_de_compra_id,
            'tipos_de_pago_id'     => $this->tipos_pago_id
        ]);

        return $pago;
    }
}
