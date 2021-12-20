<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibrariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('libraries', function (Blueprint $table) {
            $table->id();

            $table->foreignId('movies_id')->nullable()->constrained('movies')->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('episodes_id')->nullable()->constrained('episodes')->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('posts_id')->nullable()->constrained('posts')->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('members_id')->nullable()->constrained('members')->onUpdate('restrict')->onDelete('restrict');



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
        Schema::dropIfExists('libraries');
    }
}
