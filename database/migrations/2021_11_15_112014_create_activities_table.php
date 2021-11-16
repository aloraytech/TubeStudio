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
            $table->string('member_type')->default('visitor');
            $table->string('subject')->default('new activity');
            $table->boolean('like')->default(false);
            $table->boolean('favourite')->default(false);
            $table->json('visitor_info')->nullable();
            $table->foreignId('movies_id')->nullable()->constrained('movies');
            $table->foreignId('shows_id')->nullable()->constrained('shows');
            $table->foreignId('seasons_id')->nullable()->constrained('seasons');
            $table->foreignId('episodes_id')->nullable()->constrained('episodes');
            $table->foreignId('posts_id')->nullable()->constrained('posts');
            $table->foreignId('members_id')->nullable()->constrained('members');
            $table->foreignId('adverts_id')->nullable()->constrained('adverts');
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
