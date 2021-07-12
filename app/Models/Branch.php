<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Branch extends Eloquent
{
    protected $collection = "branch";
    protected $connection = "mongodb";
}