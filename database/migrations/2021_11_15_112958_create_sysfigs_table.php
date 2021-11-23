<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSysfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sysfigs', function (Blueprint $table) {
            $table->id();
            $table->string('slogan')->nullable();
            $table->string('favicon')->nullable();
            $table->string('logo')->nullable();
            $table->json('keywords')->nullable();
            $table->text('desc')->nullable();
            $table->text('header')->nullable();
            $table->string('index_bg')->nullable();
            $table->string('login_bg')->nullable();
            $table->string('signup_bg')->nullable();
            $table->boolean('private')->default(false);
            $table->boolean('coming_soon')->default(false);
            $table->dateTime('coming_soon_upto')->nullable();
            $table->boolean('installed')->default(true);
            $table->integer('per_page')->default(10);
            $table->string('player_size')->default('21by9');
            $table->boolean('slider')->default(true);
            $table->boolean('upcoming_section')->default(true);
            $table->string('theme')->default('webtube');
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
        Schema::dropIfExists('sysfigs');
    }
}
