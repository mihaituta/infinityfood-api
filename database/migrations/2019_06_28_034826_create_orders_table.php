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
        if (!Schema::hasTable('orders')) {
            Schema::create('orders', function (Blueprint $table) {
                $table->increments('id');
                $table->timestamps();
                $table->tinyInteger('status');
                $table->float('totalPrice');
                $table->text('menus');
                $table->string('name', 100);
                $table->string('phone', 100);
                $table->string('city', 50);
                $table->string('adresa', 200);
                $table->string('bloc', 100);
                $table->string('scara', 100);
                $table->string('etaj', 100);;
                $table->string('apartament', 100);
                $table->string('interfon', 100);
                $table->text('informations');
                $table->integer('store_id')->unsigned();
                $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
            });
        }
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
