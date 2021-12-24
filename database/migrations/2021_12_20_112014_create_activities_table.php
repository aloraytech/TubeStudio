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
            $table->string('in_time');
            $table->string('out_time');
            $table->string('subject')->default('new activity');
            $table->string('url_visit')->nullable();
            $table->string('url_from')->nullable();
            $table->boolean('guest')->default(true);
            $table->string('guest_contact')->nullable();
            $table->foreignId('members_id')->nullable()->constrained('members')->onUpdate('cascade')->onDelete('cascade');
            $table->json('detail')->nullable();
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
