<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('stores')) {
            Schema::create('stores', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->timestamps();
                $table->string('name', 100);
                $table->string('slug', 100);
                $table->integer('user_id');
                $table->text('city');
                $table->string('previewDescription', 200);
                $table->string('previewImage', 100);
                $table->string('backgroundImage', 100);
                $table->string('logoImage', 100);
                $table->text('contactText');
                $table->string('phone1', 50);
                $table->string('phone2', 50);
                $table->string('mail1', 50);
                $table->string('mail2', 50);
                $table->text('aboutText');
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
        Schema::dropIfExists('stores');
    }
}
