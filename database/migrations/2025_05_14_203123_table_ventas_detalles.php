<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableVentasDetalles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'ventas_detalles',
            function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('venta_id');
                $table->unsignedBigInteger('producto_id');
                $table->enum('tipo_venta', ['unidad', 'caja']); // <-- Tipo de venta
                $table->integer('cantidad');
                $table->decimal('precio_unitario', 10, 2); // Puede ser el precio por unidad o por caja
                $table->decimal('subtotal', 10, 2);
                $table->timestamps();

                $table->foreign('venta_id')->references('id')->on('ventas')->onDelete('cascade');
                $table->foreign('producto_id')->references('id')->on('productos');
            }

        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
