<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class infoUser extends Eloquent
{
    protected $collection = 'infouser';
    protected $connection = 'mongodb';
    protected $fillable = [
        'idUser',
        'fullname',
        'email',
        'phone',
        'city',
        'state',
        'country',
        'fullAdd',
        'qtyProd',
        'grandTotal'
    ];
}
