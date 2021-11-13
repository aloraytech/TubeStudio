<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advert', function (Blueprint $table) {
            $table->id();
            $table->string('position');
            $table->string('provider')->default('undefined');
            $table->text('code');
            $table->string('url')->nullable();
            $table->boolean('status')->default(true);
            $table->integer('views')->nullable();
            $table->foreignId('activity_id')->nullable()->constrained('activities')
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
        Schema::dropIfExists('advert');
    }
}
