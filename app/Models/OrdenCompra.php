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
        'user_id',
        'status'
    ];

    // relacion con detalle orden de compra
    public function detalleOrdenCompra()
    {
        return $this->hasMany(DetalleOrdenCompra::class, 'ordenes_de_compra_id', 'id');
    }

    public function pagos(){
        return $this->hasMany(Pago::class, 'ordenes_de_compra_id', 'id');
    }

    // relacion con iva
    public function iva()
    {
        return $this->belongsTo(Iva::class);
    }

    // relacion con proveedor
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class,'proveedores_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }


    /** ============================== METODOS ========================= */

    public function getNumeroPagosPagados()
    {
        $total = Pago::where('ordenes_de_compra_id', $this->id)
                    ->where('status', 'pagado')->count('id');

        return $total;
    }

}
