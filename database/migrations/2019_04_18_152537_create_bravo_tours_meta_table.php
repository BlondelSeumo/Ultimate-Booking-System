<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBravoToursMetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bravo_tour_meta', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('tour_id')->nullable();

            $table->tinyInteger('enable_person_types')->nullable();
            $table->text('person_types')->nullable();

            $table->tinyInteger('enable_extra_price')->nullable();
            $table->text('extra_price')->nullable();

            $table->text('discount_by_people')->nullable();

            $table->tinyInteger('enable_open_hours')->nullable();
            $table->text('open_hours')->nullable();


            $table->integer('create_user')->nullable();
            $table->integer('update_user')->nullable();

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
        Schema::dropIfExists('bravo_tour_meta');
    }
}
