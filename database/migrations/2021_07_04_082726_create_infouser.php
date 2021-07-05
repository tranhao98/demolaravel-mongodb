<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfouser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infouser', function ($collection) {
            $collection->string('idUser');
            $collection->string('fullname');
            $collection->string('email');
            $collection->integer('phone');
            $collection->string('city');
            $collection->string('state');
            $collection->string('country');
            $collection->string('fullAdd');
            $collection->integer('grandTotal');
            $collection->integer('qtyProd');
            $collection->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('infouser');
    }
}
