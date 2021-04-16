<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $table = "pagos";

    protected $dates = [
        'fecha'
    ];

    protected $fillable = [
        'fecha',
        'cantidad',
        'status',
        'ordenes_de_compra_id',
        'tipos_de_pago_id'
    ];

    // relacion con tipo de pago
    public function tipoDePago()
    {
        return $this->belongsTo(TipoPago::class,'tipos_de_pago_id', 'id');
    }
}
