<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('ItemId');
            $table->foreign('CategoryId')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('SubCategoryId')->references('id')->on('SubCategory')->onDelete('cascade');
            $table->foreign('MenuId')->references('id')->on('menus')->onDelete('cascade');
            $table->date('DaysAvaiable');
            $table->time('HoursAvaiable');
            $table->string('PicturePath');
            $table->date('PromoDays');
            $table->number('PromoValuePercent');
            $table->number('Value');
            $table->boolean('active');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
