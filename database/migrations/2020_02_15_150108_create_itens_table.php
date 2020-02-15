<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('category_id');
            //$table->foreign('category__id')->references('id')->on('categorys')->onDelete('cascade');
            $table->bigInteger('subCategory_id');
            //$table->foreign('subCategory__id')->references('id')->on('subCategorys')->onDelete('cascade');
            $table->bigInteger('menu_id');
            //$table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');
            $table->dateTime('daysAvailable');
             // VERIFY IF THE TYPE IS CORRECT 
            $table->dateTime('hoursAvailable');  
            // VERIFY IF THE TYPE IS CORRECT         
            $table->string('picturePath');
            $table->dateTime('promoDays'); 
            // VERIFY IF THE TYPE IS CORRECT
            $table->Integer('promoValuePercent');
            $table->Float('value');
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
        Schema::dropIfExists('itens');
    }
}
