<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
//            $table->foreignId('packages_id')->nullable()->constrained('packages')
//                ->onUpdate('cascade')
//                ->onDelete('cascade');
            $table->foreignId('members_id')->nullable()->constrained('members')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('payment_id')->nullable();
            $table->string('payment_code')->nullable();
            $table->string('provider')->nullable();
            $table->dateTime('expire_on')->nullable();
            $table->text('details')->nullable();
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
        Schema::dropIfExists('subscriptions');
    }
}
