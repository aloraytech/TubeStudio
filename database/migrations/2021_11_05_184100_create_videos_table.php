<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author')->nullable();
            $table->string('channel')->nullable();
            $table->integer('height')->nullable();
            $table->integer('width')->nullable();
            $table->string('provider')->nullable();
            $table->string('thumb_url')->nullable();
            $table->string('thumb_h')->nullable();
            $table->string('thumb_w')->nullable();
            $table->text("code")->nullable();
            $table->string('url_path')->unique();
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
        Schema::dropIfExists('videos');
    }
}
