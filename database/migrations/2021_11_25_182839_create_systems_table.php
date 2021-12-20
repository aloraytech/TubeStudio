<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('systems', function (Blueprint $table) {
            $table->id();
            $table->string('slogan')->nullable();
            $table->string('favicon')->nullable();
            $table->string('logo')->nullable();
            $table->text('keywords')->nullable();
            $table->text('desc')->nullable();
            $table->text('header')->nullable();
            $table->string('lang')->default('en');
            $table->boolean('coming_soon')->default(false);
            $table->dateTime('coming_soon_upto')->nullable();
            $table->integer('per_page')->default(10);
            $table->string('player_size')->default('21by9');
            $table->string('index_bg')->nullable();
            $table->string('login_bg')->nullable();
            $table->string('signup_bg')->nullable();
            $table->foreignId('themes_id')->constrained('themes')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->boolean('has_slider')->default(true);
            $table->boolean('has_upcoming')->default(true);
            $table->boolean('movie_pack')->default(true);
            $table->boolean('show_pack')->default(true);
            $table->boolean('trailer_pack')->default(true);
            $table->boolean('blog_pack')->default(true);
            $table->boolean('advert_pack')->default(true);
            $table->boolean('social_pack')->default(false);
            $table->boolean('shop_pack')->default(false);
            $table->boolean('private_pack')->default(true);
            $table->boolean('payment_pack')->default(true);
            $table->boolean('activity_pack')->default(true);
            $table->boolean('installed')->default(true);
            $table->text('secret')->nullable();
            $table->boolean('valid_secret')->default(true);
            $table->dateTime('valid_upto')->nullable();
            $table->string('client_email')->nullable();
            $table->string('contact_us')->nullable();
            $table->string('version')->nullable();
            $table->string('ray_api')->default('https://client.aloraytech.in');
            $table->string('suite_by')->default('Aloray Technologies');
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
        Schema::dropIfExists('system');
    }
}
