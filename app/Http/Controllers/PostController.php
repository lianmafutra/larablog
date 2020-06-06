<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\Category;
use App\Http\Requests\PostStoreRequest;
use App\Tag;
use Barryvdh\Debugbar\Facade as Debugbar;
use Clockwork\Clockwork;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use DB;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = Post::with(['category', 'users', 'tags'])->orderBy('updated_at', 'DESC')->get();


        if ($request->ajax()) {

            $data = '<li>aaa</li>';

            return datatables()->of($posts, $data)
                ->editColumn('thumbnail', function (Post $post) {
                    return '<img src="' . $post->getThumbnail() . '" height="150px" width="150px" style="object-fit: cover">';
                })
                ->editColumn('category.name', function (Post $post) {
                    return '<h6 class="badge badge-info"> ' . $post->category->name . '</h6>';
                })
                ->editColumn('tags', function (Post $post) {

                    $data = [];
                    for ($i = 0; $i < count($post->tags); $i++) {
                        array_push($data, '<li class="badge badge-secondary" style="margin-bottom:5px" >' . $post->tags[$i]->name . '</li>');
                    }

                    return  implode(" ", $data);
                })
                ->addColumn('action', 'admin.post.action')
                ->addIndexColumn()
                ->rawColumns(['thumbnail', 'action', 'category.name', 'tags']) // wajib untuk menmapilkan memproses html misal gambar
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
        try {
            DB::beginTransaction();
            $category = Category::all();
            $tags = Tag::get();
            DB::commit();
            return view('admin.post.create', compact('category', 'tags'));
        } catch (\Throwable $th) {
            DB::rollback();
        }
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

        $post->tags()->attach($request->tags);
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
        //  $post = Post::find($id);
        $post = Post::with(['category', 'users', 'tags'])->find($id);



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
