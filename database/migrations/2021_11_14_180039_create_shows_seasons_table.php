<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShowsSeasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shows_seasons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seasons_id')->constrained('seasons')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('shows_id')->constrained('shows')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
        Schema::dropIfExists('shows_seasons');
    }
}
