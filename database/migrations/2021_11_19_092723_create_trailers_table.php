<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrailersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trailers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('banner')->nullable();
            $table->text('desc')->nullable();
            $table->string('duration')->nullable();
            $table->foreignId('videos_id')->constrained('videos')
                 ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('seasons_id')->constrained('seasons')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
        Schema::dropIfExists('trailers');
    }
}
