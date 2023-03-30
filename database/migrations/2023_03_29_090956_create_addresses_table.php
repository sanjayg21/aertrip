<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');            
            $table->string('line_one', 255);            
            $table->string('line_two', 255)->nullable($value = true);            
            $table->string('city', 100);            
            $table->string('state', 100);            
            $table->string('country', 100);           
            $table->string('zip_code', 15)->nullable($value = true);
            $table->timestamps();
            
             $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
