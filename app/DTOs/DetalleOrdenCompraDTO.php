<?php

namespace App\DTOs;

class DetalleOrdenCompraDTO {

    private $descripcion;
    private $unidad;
    private $cantidad;
    private $valor_unitario;
    private $ordenes_de_compra_id;

    public function __construct
    (
        $descripcion,
        $unidad,
        $cantidad,
        $valor_unitario,
        $ordenes_de_compra_id
    )
    {
       $this->descripcion          = $descripcion;
       $this->unidad               = $unidad;
       $this->cantidad             = $cantidad;
       $this->valor_unitario       = $valor_unitario;
       $this->ordenes_de_compra_id = $ordenes_de_compra_id; 
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function getUnidad()
    {
        return $this->unidad;
    }

    public function getCantidad()
    {
        return $this->cantidad;
    }

    public function getValorUnitario()
    {
        return $this->valor_unitario;
    }

    public function getOrdenCompraId()
    {
        return $this->ordenes_de_compra_id;
    }
}