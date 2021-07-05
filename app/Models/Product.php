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
        'urlHinh',
        'gia',
        'giaKM',
        'slug',
        'moTa',
    ];
    public function category(){
        return $this->belongsTo(Category::class, 'idNSX','_id');
    }
}
