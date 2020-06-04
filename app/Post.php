<?php

namespace App;

use App\Http\Requests\PostStoreRequest;
use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;


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
}
