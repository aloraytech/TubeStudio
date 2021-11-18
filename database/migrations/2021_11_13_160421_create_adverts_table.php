<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adverts', function (Blueprint $table) {
            $table->id();
            $table->string('position');
            $table->string('provider')->default('undefined');
            $table->string('banner')->nullable();
            $table->text('code');
            $table->string('target_url')->nullable();
            $table->integer('target_view')->nullable();
            $table->integer('target_click')->nullable();
            $table->string('target_country')->default('india');
            $table->integer('views')->nullable();
            $table->integer('clicks')->nullable();
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('advert');
    }
}
