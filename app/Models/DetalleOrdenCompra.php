<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleOrdenCompra extends Model
{
    use HasFactory;

    protected $table = "detalle_orden_de_compra";

    // relacion con orden de compra
    public function ordenCompra(){
        return $this->belongsTo(OrdenCompra::class);
    }
}
