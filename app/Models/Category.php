<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Category extends Eloquent
{
    protected $collection = 'nhasanxuat';
    protected $connection = 'mongodb';
    protected $fillable = [
        'tenNSX',
        'slug',
        'moTa',
    ];
}
