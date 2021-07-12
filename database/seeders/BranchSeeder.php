<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Branch;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $branchDocuments = [
            ['name'=>'iPhone Branch','logo'=>'iphone-logo.jpg','phone'=>'0902448662','city'=>'Ho Chi Minh City',
            'address'=>'281 Hai Ba Trung, District 3, Ho Chi Minh City','slug'=>'zphone','geolocation'=> '108.7,107.8']
        ];
        Branch::insert($branchDocuments);
    }
}
