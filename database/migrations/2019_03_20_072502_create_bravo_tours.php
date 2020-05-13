<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBravoTours extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bravo_tours', function (Blueprint $table) {
            $table->bigIncrements('id');
            //Tour info
            $table->string('title', 255)->nullable();
            $table->string('slug',255)->charset('utf8')->index();
            $table->text('content')->nullable();
            $table->integer('image_id')->nullable();
            $table->integer('banner_image_id')->nullable();
            $table->text('short_desc')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('location_id')->nullable();
            $table->string('address', 255)->nullable();
            $table->string('map_lat',20)->nullable();
            $table->string('map_lng',20)->nullable();
            $table->integer('map_zoom')->nullable();
            $table->tinyInteger('is_featured')->nullable();
            $table->string('gallery', 255)->nullable();
            $table->string('video', 255)->nullable();
            //Price
            $table->decimal('price', 12,2)->nullable();
            $table->decimal('sale_price', 12,2)->nullable();

            //Tour type
            $table->integer('duration')->nullable();
            $table->integer('min_people')->nullable();
            $table->integer('max_people')->nullable();

            //Extra Info
            $table->text('faqs')->nullable();
            $table->string('status',50)->nullable();
            $table->dateTime('publish_date')->nullable();
            $table->bigInteger('create_user')->nullable();
            $table->bigInteger('update_user')->nullable();
            $table->softDeletes();
            
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
        Schema::dropIfExists('bravo_tours');
    }
}
