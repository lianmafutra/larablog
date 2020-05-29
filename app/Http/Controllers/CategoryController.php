<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\CategoryStoreRequest;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Category $category)
    {
        if ($request->ajax()) {
            $category = Category::orderBy('id', 'desc');
            //  $users = DB::table('users')->paginate(15);
            return datatables()->of($category)
            ->addColumn('action', 'admin.category.action')
            ->addIndexColumn()
            ->make(true);
        }
      
        $category = Category::orderBy('id', 'desc');
        return view('admin.category.index', compact('category'));
    
    }

    public function getall()
    {
    //    $category = Category::orderBy('id', 'desc');
    //    return datatables()->of($category)
    //    ->addColumn('action', 'admin.category.action')
    //    ->addIndexColumn()
    //    ->make(true);


    }
 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Category::updateOrCreate(['id' => $request->id],
        //         ['name' => $request->name]);        
   
        // return response()->json(['success'=>'Product saved successfully.']);
        // $category =  Category::create([
        //     'name' => $request->name,
        //     'slug'=> Str::slug($request->name)
        // ]);    

        // $validated = $request->validated(); // check validate true/false, Will return only validated data
        
        // return redirect()->back()->withSuccess('added new category '.$request->name.' successfuly');
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
        $category = Category::find($id);
        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    
        $post = Category::find($id)->update($request->all());
        return response()->json(['success'=>'Product saved successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
