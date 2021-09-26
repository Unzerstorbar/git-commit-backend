<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RoleCompany extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_company', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_role');
            $table->foreign('id_role')->references('id')->on('roles');

            $table->foreignId('id_company');
            $table->foreign('id_company')->references('id')->on('company');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_company');
    }
}
