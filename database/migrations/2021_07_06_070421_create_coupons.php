<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoupons extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function ($collection) {
            $collection->string('coupon_option');
            $collection->string('coupon_code');
            $collection->text('categories');
            $collection->text('users');
            $collection->string('coupon_type');
            $collection->string('amount_type');
            $collection->float('amount');
            $collection->date('expiry_date');
            $collection->tinyInteger('status');
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
        Schema::dropIfExists('coupons');
    }
}
