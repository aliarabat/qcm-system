<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQcmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qcms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('description');
            $table->text('reference');
            $table->unsignedInteger('duration');
            $table->unsignedInteger('difficulty');
            $table->bigIncrements('semestere_module_id');
            $table->foreign('semestre_module_id')->references('semestre_module')->on('semestere_module');
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
        Schema::dropIfExists('qcms');
    }
}
