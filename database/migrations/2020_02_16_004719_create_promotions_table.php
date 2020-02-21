<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('item_id');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->string('daysAvailable')->nullable($value=true);         
            $table->string('startTime')->nullable($value=true);         
            $table->string('finishTime')->nullable($value=true); 
            $table->float('promoValuePercent')->nullable($value=true);
            $table->float('value')->nullable($value=true);         
            $table->boolean('active')->nullable($value=true);         
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
        Schema::dropIfExists('promotions');
    }
}
