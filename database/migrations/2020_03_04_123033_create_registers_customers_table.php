<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistersCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registers_customers', function (Blueprint $table) {
            $table->increments('id');
            $table->datetime('fecha');
            $table->string('slug');

            $table->integer('employees_id')->unsigned();
            $table->foreign('employees_id')->references('id')->on('employees');

            $table->integer('customers_id')->unsigned()->nullable();
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
        Schema::dropIfExists('registers_customers');
    }
}
