<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaveFoodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('save_food', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('customers')->onDelete('cascade');
            $table->string('no_of_peoples');
            $table->enum('status', ['Pending', 'Processing','Completed', 'Cancelled'])->default('Pending');
            $table->string('address');
            $table->float('lat');
            $table->float('lng');
            $table->string('city');
            $table->string('zip_code');
            $table->string('image')->nullable();
            $table->string('message');
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
        Schema::dropIfExists('save_food');
    }
}
