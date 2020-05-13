<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBravoReviewMeta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bravo_review_meta', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('review_id')->nullable();
            $table->integer('object_id')->nullable();
            $table->string('object_model',255)->nullable();
            $table->string('name',255)->nullable();
            $table->text('val')->nullable();

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
        Schema::dropIfExists('bravo_review_meta');
    }
}
