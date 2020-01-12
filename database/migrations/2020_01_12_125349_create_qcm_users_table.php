<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQcmUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qcm_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('is_passed');
            $table->double('note');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('qcm_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('qcm_id')->references('id')->on('qcms');
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
        Schema::dropIfExists('qcm_users');
    }
}
