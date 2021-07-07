<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use App\Models\Product;

class Cart extends Eloquent
{
    protected $collection = 'cart';
    protected $connection = 'mongodb';
    protected $fillable = [
        'idUser',
        'idProd',
        'qtyProd',
        'idNSX'
    ];


    public function products(){
        return $this->belongsTo(Product::class,'idProd','_id');
    }
}
