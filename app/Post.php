<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Post extends Model
{
    protected $fillable = ['title', 'content', 'thumbnail', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getThumbnail()
    {
        // jika mempunyai value dari database
        if ($this->thumbnail) {
            return asset('/storage/upload/' . $this->thumbnail);
        }

        // jika kedua kondisi diatas tidak terpenuhi 
        return 'https://via.placeholder.com/150x200.png?text=No+Cover';
    }
}
