<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Coupons;
class CouponsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $couponDocuments = [
            ['coupon_option'=>'Manual','coupon_code'=>'test10','categories'=>'1,2','users'=>'hao@gmail.com,hao159@gmail.com',
            'coupon_type'=>'Single','amount_type'=>'Percentage','amount'=>'100000','expiry_date'=>'2020-12-31','status'=>'1']
        ];
        Coupons::insert($couponDocuments);
    }
}
