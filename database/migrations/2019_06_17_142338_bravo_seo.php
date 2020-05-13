<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BravoSeo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bravo_seo', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('object_id')->nullable();
            $table->string('object_model',255)->nullable();
            $table->tinyInteger('seo_index')->nullable();
            $table->string('seo_title', 255)->nullable();
            $table->text('seo_desc')->nullable();
            $table->integer('seo_image')->nullable();
            $table->text('seo_share')->nullable();
            $table->bigInteger('create_user')->nullable();
            $table->bigInteger('update_user')->nullable();
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
        Schema::dropIfExists('bravo_seo');
    }
}
