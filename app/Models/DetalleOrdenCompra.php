<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleOrdenCompra extends Model
{
    use HasFactory;

    protected $table = "detalle_orden_de_compra";

    protected $fillable = [
        'descripcion',
        'unidad',
        'cantidad',
        'valor_unitario',
        'ordenes_de_compra_id'
    ];

    /* relacion con orden de compra */
    public function ordenCompra(){
        return $this->belongsTo(OrdenCompra::class,'ordenes_de_compra_id', 'id');
    }
    
}
