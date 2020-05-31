<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Post extends Model
{
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
