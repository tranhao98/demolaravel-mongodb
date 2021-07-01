<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Product extends Eloquent
{
    protected $collection = 'dienthoai';
    protected $connection = 'mongodb';
    protected $fillable = [
        'idNSX',
        'tenDT',
        'gia',
        'giaKM',
        'slug',
        'moTa',
    ];
}
