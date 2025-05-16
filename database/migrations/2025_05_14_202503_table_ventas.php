<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableVentas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
             $table->id();
            $table->unsignedBigInteger('cliente_id')->nullable(); // Puedes hacerla nullable si no siempre hay cliente
            $table->unsignedBigInteger('usuario_id'); // Usuario que hizo la venta
            $table->dateTime('fecha');
            $table->decimal('total', 10, 2);
            $table->string('estado')->default('activa'); // o anulada, etc.
            $table->timestamps();

            $table->foreign('cliente_id')->references('id')->on('personas')->onDelete('set null');
            $table->foreign('usuario_id')->references('id')->on('users');
           
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
        
    }
}
