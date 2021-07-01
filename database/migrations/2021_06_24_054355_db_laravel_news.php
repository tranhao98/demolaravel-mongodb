<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DbLaravelNews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('dienthoai', function ($collection) {
            $collection->string('tenDT');
            $collection->string('urlHinh');
            $collection->integer('gia');
            $collection->integer('giaKM');
            $collection->text('moTa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dienthoai');
    }
}
