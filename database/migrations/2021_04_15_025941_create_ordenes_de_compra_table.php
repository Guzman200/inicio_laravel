<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenesDeCompraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordenes_de_compra', function (Blueprint $table) {
            $table->id();
            $table->integer('num_pagos');
            $table->integer('num_facturas');
            $table->string('centro_costo');
            $table->string('cotizacion');
            $table->string('proyecto');
            $table->string('observaciones')->nullable();
            $table->float('total');
            $table->float('total_neto');
            $table->float('subtotal');
            $table->float('descuento');
            $table->string('status')->default('por pagar');
            /*
                por pagar
                pagada
            */
            $table->unsignedBigInteger('iva_id');
            $table->unsignedBigInteger('proveedores_id');
            $table->unsignedBigInteger('user_id');
            
            $table->foreign('iva_id')
                ->references('id')
                ->on('iva');

            $table->foreign('user_id')
                ->references('id')
                ->on('users');
           
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
        Schema::dropIfExists('ordenes_de_compra');
    }
}
