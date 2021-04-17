<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->float('cantidad');
            $table->string('status')->default('por pagar');
            $table->date('fecha_en_que_se_pago')->nullable();
            /*
                por pagar
                pagado
            */
            $table->unsignedBigInteger('ordenes_de_compra_id');
            $table->unsignedBigInteger('tipos_de_pago_id');

            $table->foreign('ordenes_de_compra_id')
                ->references('id')
                ->on('ordenes_de_compra');

            $table->foreign('tipos_de_pago_id')
                ->references('id')
                ->on('tipos_de_pago');

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
        Schema::dropIfExists('pagos');
    }
}
