<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search') ? $request->input('search') : '';

        $sortBy = $request->get('sortby');

        $categories = Category::where('category_name', 'like', '%' . $search . '%');

        if ($sortBy == 'newest')
        {
            $categories = $categories->orderBy('created_at', 'desc');
        }

        if ($sortBy == 'latest')
        {
            $categories = $categories->orderBy('created_at', 'asc');
        }

        if ($sortBy == 'a-z')
        {
            $categories = $categories->orderBy('category_name', 'asc');
        }

        if ($sortBy == 'z-a')
        {
            $categories = $categories->orderBy('category_name', 'desc');
        }

        $categories = $categories->orderBy('created_at', 'desc')->paginate(10);

        return view('admins.categories.index', [
            'categories' => $categories,
            'total'  => $categories->total(),
            'perPage' => $categories->perPage(),
            'currentPage' => $categories->currentPage()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'category_name' => 'required|max:50',
        ]);

        $category = new Category();
        $category->category_name = $request->input('category_name');
        $category->save();
        
        toast('Data Has Been Added', 'success');
        return back();
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
        //
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
        $this->validate(request(), [
            'category_name' => 'required|max:50',
        ]);

        $category = Category::findOrFail($id);
        $category->category_name = $request->input('category_name');
        $category->update();

        toast('Data Has Been Updated', 'success');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id)->delete();

        toast('Data Has Been Deleted', 'success');
        return back();
    }
}
