<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Cviebrock\EloquentSluggable\Sluggable;

class Blog extends Eloquent
{
    use Sluggable;
    
    protected $collection = 'blog';
    protected $connection = 'mongodb';
    protected $fillable = [
        'title',
        'slugblog',
        'description',
        'image_path',
        'idUser'
    ];
    public function users()
    {
        return $this->belongsTo(User::class, 'idUser', '_id');
    }

    public function sluggable(): array
    {
        return [
            'slugblog' => [
                'source' => 'title'
            ]
        ];
    }


}
