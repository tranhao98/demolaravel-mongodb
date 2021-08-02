<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class PostComment extends Eloquent
{
    protected $collection = 'post_comment';
    protected $connection = 'mongodb';
    protected $fillable = [
        'idUser',
        'idPost',
        'comment'
    ];

    public function users(){
        return $this->belongsTo(User::class,'idUser','_id');
    }
}
