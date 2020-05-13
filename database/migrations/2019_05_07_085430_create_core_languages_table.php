<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoreLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('core_languages', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('locale',10)->nullable();
            $table->string('name',255)->nullable();
            $table->string('flag',255)->nullable();

            $table->string('status',20)->nullable();

            $table->integer('create_user')->nullable();
            $table->integer('update_user')->nullable();
            $table->timestamp('last_build_at')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('core_languages');
    }
}
