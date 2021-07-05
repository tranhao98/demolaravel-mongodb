<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_products', function ($collection) {
            $collection->string('idUser');
            $collection->string('idOrders');
            $collection->string('idProd');
            $collection->integer('quantity');
            $collection->integer('grandTotal');
            $collection->integer('subTotal');
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
        Schema::dropIfExists('orders_products');
    }
}
