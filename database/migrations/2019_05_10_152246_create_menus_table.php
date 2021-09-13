<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('menus')) {
            Schema::create('menus', function (Blueprint $table) {
                $table->increments('id');
                $table->timestamps();
                $table->string('name', 100);
                $table->text('description');
                $table->float('price');
                $table->string('image', 100);
                $table->string('type', 50);
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
        Schema::dropIfExists('menus');
    }
}
