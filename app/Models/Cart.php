<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Cart extends Eloquent
{
    protected $collection = 'cart';
    protected $connection = 'mongodb';
    protected $fillable = [
        'idUser',
        'idProd',
        'qtyProd',
    ];
}
