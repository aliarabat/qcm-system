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
            $table->string('difficulte'); 
            $table->unsignedInteger('vote'); 
            $table->string('validite', 20)->default('invalid');
            $table->double('note'); 
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
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
