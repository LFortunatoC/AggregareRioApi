<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('order_id');
            //$table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->bigInteger('questionPoll_id');
            //$table->foreign('questionPoll_id')->references('id')->on('questionPolls')->onDelete('cascade');
            $table->bigInteger('client_id');
            //$table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->Integer('evaluationValue');
            $table->string('comment');
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
        Schema::dropIfExists('evaluations');
    }
}
