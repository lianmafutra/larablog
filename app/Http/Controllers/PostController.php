<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\Category;
use App\Http\Requests\PostStoreRequest;
use Barryvdh\Debugbar\Facade as Debugbar;
use Clockwork\Clockwork;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = Post::with('category')->orderBy('updated_at', 'DESC');
        if ($request->ajax()) {
            return datatables()->of($posts)
                ->editColumn('thumbnail', function (Post $post) {
                    // return '<img src="https://www.digopaul.com/wp-content/uploads/related_images/2015/09/08/placeholder_2.jpg" height="150px">';
                    return '<img src="' . $post->getThumbnail() . '" height="150px" width="150px" style="object-fit: cover">';
                    // clock($post->getThumbnail());
                })
                ->addColumn('action', 'admin.post.action')
                ->addIndexColumn()
                ->rawColumns(['thumbnail', 'action']) // wajib untuk menmapilkan memproses html misal gambar
                ->make(true);
        }

        return view('admin.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        return view('admin.post.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostStoreRequest $request)
    {

        $thumbnail_name = null;
        if ($request->hasFile('thumbnail')) {
            $request->file('thumbnail')->store('public/upload'); //store to storage link
            $thumbnail_name = $request->thumbnail->hashName(); // get name only
        }

        $post = Post::create([
            'title'       => $request->title,
            'category_id' => $request->category_id ?? 0,
            'content'     => $request->content,
            'thumbnail'   => $thumbnail_name,
            'user_id'     => Auth::id()
        ]);

        clock($post->toArray());

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $category = Category::all();
        return view('admin.post.edit', compact('post', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostStoreRequest $request, Post $post)
    {
        try {
            $post->update([
                'title'       => $request->title,
                'category_id' => $request->category_id ?? 0,
                'content'     => $request->content,
                'thumbnail'   => $post->getThumbnailName($request, $post) ?? null
            ]);
            return redirect()->route('post.index');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        Post::DeleteOldThumbnail($post->thumbnail); // jika post dihapus gambar thumbnail juga dihapus
        return redirect()->route('post.index');
    }
}
