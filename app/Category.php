<?php

namespace App;

use Carbon\Carbon;
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

    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])
            ->format('d, M Y H:i');
    }
}
