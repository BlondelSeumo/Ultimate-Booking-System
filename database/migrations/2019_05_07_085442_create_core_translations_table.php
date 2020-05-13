<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoreTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('core_translations', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('locale',10)->nullable();
            $table->text('string')->nullable();
            $table->bigInteger('parent_id')->nullable();

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
        Schema::dropIfExists('core_translations');
    }
}
