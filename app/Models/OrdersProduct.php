<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class OrdersProduct extends Eloquent
{
    protected $collection = 'orders_products';
    protected $connection = 'mongodb';
    protected $fillable = [
        'idUser',
        'idProd',
        'idOrder',
        'product_name',
        'product_price',
        'product_qty'
    ];
    public function products(){
        return $this->belongsTo(Product::class,'idProd','_id');
    }
}
