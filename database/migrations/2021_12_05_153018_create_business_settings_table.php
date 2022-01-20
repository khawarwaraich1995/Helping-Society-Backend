<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_settings', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('emergency_phone')->nullable();
            $table->float('ride_cancellation_charges')->nullable();
            $table->integer('ride_cancellation_time')->nullable();
            $table->string('distance_unit')->nullable();
            $table->float('provider_search_radius')->nullable();
            $table->integer('driver_acceptance_time')->nullable();
            $table->float('admin_comission')->nullable();
            $table->string('date_time_format')->nullable();
            $table->string('time_format')->nullable();
            $table->string('timezone')->nullable();
            $table->string('currency')->default('$');
            $table->string('footer_text')->nullable();
            $table->string('fb_link')->nullable();
            $table->string('insta_link')->nullable();
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
        Schema::dropIfExists('business_settings');
    }
}
