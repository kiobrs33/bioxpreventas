<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->text('descripcion');
            $table->string('direccion');
            $table->string('comprobante');
            $table->double('total');
            $table->string('impuesto');
            $table->string('numero_comprobante');
            $table->string('estado');
            $table->datetime('fecha_registro');
            $table->datetime('fecha_entrega');
            $table->string('slug');

            $table->integer('employees_id')->unsigned()->nullable();
            $table->integer('customers_id')->unsigned()->nullable();

            $table->foreign('employees_id')->references('id')->on('employees');
            $table->foreign('customers_id')->references('id')->on('customers');

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
        Schema::dropIfExists('orders');
    }
}