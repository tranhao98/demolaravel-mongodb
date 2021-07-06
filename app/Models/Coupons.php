<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Coupons extends Eloquent
{
   protected $collection = 'coupons';
   protected $connection = 'mongodb';
}
