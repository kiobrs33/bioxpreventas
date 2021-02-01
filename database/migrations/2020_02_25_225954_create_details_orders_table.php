<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailsOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('details_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cantidad');
            $table->double('subtotal');

            $table->integer('products_id')->unsigned()->nullable();
            $table->integer('orders_id')->unsigned()->nullable();

            $table->foreign('products_id')->references('id')->on('products');
            $table->foreign('orders_id')->references('id')->on('orders');

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
        Schema::dropIfExists('details_orders');
    }
}