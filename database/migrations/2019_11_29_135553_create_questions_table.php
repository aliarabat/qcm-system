<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type')->default('unique'); 
            $table->string('question'); 
            $table->unsignedBigInteger('chapitre_id');
            $table->foreign('chapitre_id')->references('id')->on('chapitres')->onDelete('cascade');            
            $table->Integer('duree');
            $table->string('difficulte'); 
            $table->string('validite', 20)->default('invalid');
            $table->double('note'); 
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
        Schema::dropIfExists('questions');
    }
}
