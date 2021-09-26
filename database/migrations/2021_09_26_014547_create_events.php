<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->text('description');
            $table->date('date');
            $table->integer('participants')->default(0);
            $table->integer('organizers')->default(0);
            $table->integer('index');

            $table->foreignId('image_id');
            $table->foreign('image_id')->references('id')->on('images');

            $table->foreignId('city_id');
            $table->foreign('city_id')->references('id')->on('cities');

            $table->foreignId('venue_id');
            $table->foreign('venue_id')->references('id')->on('event_venues');

            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->foreignId('event_status_id')->default(2);
            $table->foreign('event_status_id')->references('id')->on('event_venues');
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
        Schema::dropIfExists('events');
    }
}
