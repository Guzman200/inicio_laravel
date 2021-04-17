<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $table = "pagos";

    protected $dates = [
        'fecha',
        'fecha_en_que_se_pago'
    ];

    protected $fillable = [
        'fecha',
        'cantidad',
        'status',
        'ordenes_de_compra_id',
        'tipos_de_pago_id',
        'fecha_en_que_se_pago'
    ];

    // relacion con tipo de pago
    public function tipoDePago()
    {
        return $this->belongsTo(TipoPago::class,'tipos_de_pago_id', 'id');
    }

    // relacion con orden de compra
    public function ordenDeCompra()
    {
        return $this->belongsTo(OrdenCompra::class,'ordenes_de_compra_id', 'id');
    }
}
