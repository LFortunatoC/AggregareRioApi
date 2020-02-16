<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionPoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questionPools', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('language_id');
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade');
            $table->string('question');
            $table->boolean('active');
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
        Schema::dropIfExists('questionPools');
    }
}
