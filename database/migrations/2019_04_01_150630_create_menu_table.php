<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('core_menus', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name',255)->nullable();
            $table->longText('items')->nullable();

            $table->integer('create_user')->nullable();
            $table->integer('update_user')->nullable();


            //Languages
            $table->bigInteger('origin_id')->nullable();
            $table->string('lang',10)->nullable();


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
        Schema::dropIfExists('core_menus');

    }
}
