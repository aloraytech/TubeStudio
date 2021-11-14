<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeasonEpisodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('season_episode', function (Blueprint $table) {
            $table->foreignId('seasons_id')->constrained('seasons')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('episodes_id')->constrained('episodes')
                ->onUpdate('cascade')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('season_episode');
    }
}
