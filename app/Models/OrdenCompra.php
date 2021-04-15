<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenCompra extends Model
{
    use HasFactory;

    protected $table = "ordenes_de_compra";

    protected $fillable = [
        'num_pagos',
        'num_facturas',
        'centro_costo',
        'cotizacion',
        'proyecto',
        'total',
        'total_neto',
        'subtotal',
        'descuento',
        'iva_id',
        'proveedores_id',
        'user_id'
    ];

    // relacion con detalle orden de compra
    public function detalleOrdenCompra()
    {
        return $this->hasMany(DetalleOrdenCompra::class);
    }
}
