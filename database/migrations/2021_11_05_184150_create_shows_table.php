<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateShowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shows', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('name');
            $table->string('banner')->nullable();
            $table->text('desc')->nullable();
            $table->integer('views')->nullable();
            $table->boolean('private')->default(false);
            $table->string('display_image')->nullable();
            $table->json('tags')->nullable();
            $table->foreignId('categories_id')->constrained('categories')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('age_group')->default('U');
            $table->foreignId('trailer')->nullable()->constrained('videos')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->dateTime('release_on')->nullable();
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
        Schema::dropIfExists('shows');
    }
}
