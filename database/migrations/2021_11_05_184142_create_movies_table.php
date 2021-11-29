<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categories_id')->constrained('categories')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('videos_id')->constrained('videos')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('name');
            $table->string('quality')->nullable();
            $table->string('banner')->nullable();
            $table->text('desc')->nullable();
            $table->text('tags')->nullable();
            $table->integer('views')->nullable();
            $table->boolean('private')->default(false);
            $table->string('age_group')->default('U');
            $table->dateTime('release_on')->nullable();
            $table->string('duration')->nullable();
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
        Schema::dropIfExists('movies');
    }
}
