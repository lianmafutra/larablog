<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;


class Post extends Model
{
    protected $fillable = ['title', 'content', 'thumbnail', 'category_id', 'user_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    //Relasi many to many dengan tags 
    // 1 post * tags
    // 1 tags * post
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
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

    public function getThumbnailName($request, $post)
    {
        //jika thumbnail diupdate dengan gambar baru
        if ($request->hasFile('thumbnail')) {
            $request->file('thumbnail')->store('public/upload'); //store to storage link
            $thumbnail_name = $request->thumbnail->hashName(); // get name only
            $this->deleteOldThumbnail($post->thumbnail);

            // jika thumbnail dihapus user / post tanpa thumbnail
        } else if (($request->thumb_stat) == 'hapus') {
            $thumbnail_name = null;
            $this->deleteOldThumbnail($post->thumbnail);
        } else {

            $thumbnail_name = $post->thumbnail; //mengambil nama thumbnail default dari model binding post
        }
        return $thumbnail_name;
    }

    //menghapus thumbnail lama ketika update thumbnail post
    public static function deleteOldThumbnail($thumbnail_name)
    {
        Storage::delete('public/upload/' . $thumbnail_name);
    }

    //Accessors date , eloquent sudah terintegrasi dengan class carbon 
    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])
            ->format('d, M Y H:i');
    }
}
