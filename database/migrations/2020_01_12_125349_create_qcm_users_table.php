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
            $table->boolean('is_passed')->default(false);
            $table->double('note')->default(0);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('qcm_id');
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
