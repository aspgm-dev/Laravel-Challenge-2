<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
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

        $tags = Tag::where('tag_name', 'like', '%' . $search . '%');

        if ($sortBy == 'newest')
        {
            $tags = $tags->orderBy('created_at', 'desc');
        }

        if ($sortBy == 'latest')
        {
            $tags = $tags->orderBy('created_at', 'asc');
        }

        if ($sortBy == 'a-z')
        {
            $tags = $tags->orderBy('tag_name', 'asc');
        }

        if ($sortBy == 'z-a')
        {
            $tags = $tags->orderBy('tag_name', 'desc');
        }

        $tags = $tags->orderBy('created_at', 'desc')->paginate(10);

        
        return view('admins.tags.index', [
            'tags' => $tags,
            'total'  => $tags->total(),
            'perPage' => $tags->perPage(),
            'currentPage' => $tags->currentPage()
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
            'tag_name' => 'required|max:50',
        ]);

        $tag = new Tag();
        $tag->tag_name = $request->input('tag_name');
        $tag->save();

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
            'tag_name' => 'required|max:50',
        ]);

        $tag = Tag::findOrFAil($id);
        $tag->tag_name = $request->input('tag_name');
        $tag->update();

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
        $tag = Tag::findOrFail($id)->delete();

        toast('Data Has Been Deleted', 'success');
        return back();
    }
}
