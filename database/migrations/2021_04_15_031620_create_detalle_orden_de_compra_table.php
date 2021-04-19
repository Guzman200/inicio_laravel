<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleOrdenDeCompraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_orden_de_compra', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');
            $table->string('unidad');
            $table->float('cantidad');
            $table->float('valor_unitario');
            $table->unsignedBigInteger('ordenes_de_compra_id');

            $table->foreign('ordenes_de_compra_id')
                ->references('id')
                ->on('ordenes_de_compra')
                ->cascadeOnDelete();
                
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_orden_de_compra');
    }
}
