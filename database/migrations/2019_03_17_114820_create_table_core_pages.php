<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreateTableCorePages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('core_pages', function (\Illuminate\Database\Schema\Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug',255)->charset('utf8')->index();
            $table->string('title',255)->nullable();
            $table->text('content')->nullable();
            $table->text('short_desc')->nullable();
            $table->string('status',50)->nullable();
            $table->dateTime('publish_date')->nullable();
            $table->integer('image_id')->nullable();
            $table->integer('template_id')->nullable();

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
        Schema::dropIfExists('core_pages');
    }
}
