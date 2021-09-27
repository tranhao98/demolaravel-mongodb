<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Contact extends Eloquent
{
    protected $collection = 'contact';
    protected $connection = 'mongodb';
    protected $fillable = [
        'email',
        'message'
    ];
}
