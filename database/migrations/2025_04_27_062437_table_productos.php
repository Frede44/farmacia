<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableProductos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 35)->unique();
            $table->string('nombre');
            $table->string('descripcion');
            $table->decimal('precio_venta', 8, 2); //8 dígitos en total, 2 después del punto decimal
            $table->string('imagen')->nullable(); // Campo para la imagen, puede ser nulo
            $table->unsignedBigInteger('categoria_id'); // Relación con la tabla categorias
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
        Schema::dropIfExists('productos');
    }
}
