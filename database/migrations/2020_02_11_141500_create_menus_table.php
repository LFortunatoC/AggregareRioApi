<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('client_id');
            //$table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->string('picturePath');
            $table->string('logoPath');
            $table->unsignedBigInteger('defaultLang');
            $table->foreign('defaultLang')->references('id')->on('languages')->onDelete('cascade');
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
        Schema::dropIfExists('menus');
    }
}
