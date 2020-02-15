<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
           
            $table->bigInteger('client_id')->unsigned();
            //$table->foreign('client_id')->references('id')->on('clients');
            
            $table->string('userName');
            $table->string('password');
            $table->bigInteger('level')->unsigned();
            //$table->foreign('level')->references('id')->on('user_rights');

            $table->string('enabledFeatures')->nullable($value = true);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable($value = true);
            $table->rememberToken();
            $table->boolean('active');
            $table->boolean('deleted');            
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
        Schema::dropIfExists('users');
    }
}
