<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Users extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('role_id');
            $table->foreign('role_id')->references('id')->on('roles');

            $table->string('first_name', 50);
            $table->string('second_name', 50);
            $table->string('last_name', 50);

            $table->date('birthday');

            $table->string('phone', 50);
            $table->text('about');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
