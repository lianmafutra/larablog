<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use function GuzzleHttp\Promise\all;

class Category extends Model
{


    protected $table = 'category';
    protected $fillable = ['id', 'name', 'slug'];

    public function post()
    {
        return $this->hasMany(Post::class);
    }
}
