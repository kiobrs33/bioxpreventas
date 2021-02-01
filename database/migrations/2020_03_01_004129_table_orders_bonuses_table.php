<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableOrdersBonusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_bonuses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cantidad_producto');
            $table->integer('orders_id')->unsigned()->nullable();
            $table->integer('bonuses_id')->unsigned()->nullable();
            $table->integer('products_id')->unsigned()->nullable();

            $table->foreign('orders_id')->references('id')->on('orders');
            $table->foreign('bonuses_id')->references('id')->on('bonuses');
            $table->foreign('products_id')->references('id')->on('products');
            
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
        Schema::dropIfExists('orders_bonuses');
    }
}