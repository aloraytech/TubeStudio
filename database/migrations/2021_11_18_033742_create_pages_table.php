<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title')->default('Undefined PageName');
            $table->text('desc')->nullable();
            $table->integer('position')->default(0);
            $table->string('url')->nullable();
            $table->string('target')->nullable();
            $table->integer('views')->nullable();
            $table->boolean('default_view')->default(true);
            $table->text('default_desc')->nullable();
            $table->boolean('status')->default(false);
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
        Schema::dropIfExists('pages');
    }
}
