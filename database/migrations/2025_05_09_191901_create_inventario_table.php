<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventario', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_producto'); 
            //$table->decimal('compra', 10, 2);          
            $table->decimal('xunidad', 10, 2);         
            $table->decimal('xcaja', 10, 2);                           
            $table->date('caducidad');                 
            $table->integer('cantidad_caja');  
            $table->integer('unidad_caja'); 
            $table->integer('total_unidad'); 
            $table->unsignedBigInteger('id_categoria');
            $table->boolean('estado')->default(true);
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
        Schema::dropIfExists('inventario');
    }
}
