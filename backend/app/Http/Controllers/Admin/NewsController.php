<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Image;
use App\Models\Comment;

class NewsController extends Controller
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

        $news = News::where('title', 'like', '%' . $search . '%');

        if ($sortBy == 'newest')
        {
            $news = $news->orderBy('created_at', 'desc');
        }

        if ($sortBy == 'latest')
        {
            $news = $news->orderBy('created_at', 'asc');
        }

        if ($sortBy == 'a-z')
        {
            $news = $news->orderBy('title', 'asc');
        }

        if ($sortBy == 'z-a')
        {
            $news = $news->orderBy('title', 'desc');
        }

        $news = $news->orderBy('created_at', 'desc')->paginate(10);

        return view('admins.news.index', [
            'news' => $news,
            'total'  => $news->total(),
            'perPage' => $news->perPage(),
            'currentPage' => $news->currentPage()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('admins.news.create', compact('categories', 'tags'));
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
            'title' => 'required|max:100',
            'content' => 'required',
            'image_name' => 'required',
            'category_id' => 'required',
            'tag_id' => 'required'
        ]);
        $image = $request->file('image_name');

        $news = new News();
        if ($image)
        {
            $image_path = $image->store('/images', 'public');
            $news->image_name = $image_path;
        }
        $news->title = $request->input('title');
        $news->content = $request->input('content');
        $news->category_id = $request->get('category_id');
        $news->save();
    
        $tags = $request->get('tag_id');
        if ($tags)
        {
            $tag_collect = collect($tags);
            foreach ($tag_collect as $item) 
            {
                $news->tags()->attach($item);
            }
        }

        toast('Data Has Been Added', 'success');
        return redirect()->route('admin.news.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $news = News::findOrFail($id);
        
        return view('admins.news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = News::findOrFail($id);
        $categories = Category::all();
        $tags = Tag::all();

        return view('admins.news.edit', compact(
            'news', 'categories', 'tags'
        ));
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
            'title' => 'required|max:100',
            'content' => 'required',
            'category_id' => 'required',
            'image_name' => 'required',
            'tag_id' => 'required'
        ]);

        $image = $request->file('image_name');

        $news = News::findOrFail($id);
        if($image){
            if($news->image_name && file_exists(storage_path('/images' . $news->image_name)))
            {
                \Storage::delete('storage/images/' . $news->title);
            }
            $image_path = $image->store('/images', 'public');
            $news->image_name = $image_path;
        }
        
        $news->title = $request->input('title');
        $news->content = $request->input('content');
        $news->category_id = $request->get('category_id');
        $news->save();

        $tags = Tag::whereIn('id', $request->get('tag_id'))->get();
        if ($tags)
        {
            $news->tags()->delete();
            foreach ($tags as $item) 
            {
                $news->tags()->attach($item);
            }
        }

        toast('Data Has Been Updated', 'success');
        return redirect()->route('admin.news.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = News::findOrFail($id)->delete();

        toast('Data Has Been Deleted', 'success');
        return redirect()->route('admin.news.index');
    }

    public function add_comment(Request $request)
    {
        $this->validate(request(), [
            'comment_text' => 'required'
        ]);

        $comment = new Comment();
        $comment->name = \Auth::user()->name;
        $comment->email = \Auth::user()->email;
        $comment->comment_text = $request->input('comment_text');
        $comment->news_id = $request->get('news_id');
        $comment->save();

        return back();
    }
}
