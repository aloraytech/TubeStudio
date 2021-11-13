<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('movie_id')->nullable()->constrained('movies')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('episode_id')->nullable()->constrained('episodes')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('season_id')->nullable()->constrained('seasons')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('show_id')->nullable()->constrained('shows')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->json('details')->nullable();
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
        Schema::dropIfExists('activities');
    }
}
