<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSemestreModuleProfsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('semestre_module_profs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('semestre_module_id');
            $table->foreign('semestre_module_id')->references('id')->on('semestre_modules')->onDelete('cascade');
            $table->unsignedBigInteger('professor_id');
            $table->foreign('professor_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('annee',4);
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
        Schema::dropIfExists('semestre_module_profs');
    }
}
