<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\News;

class CommentController extends Controller
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

        $comments = Comment::where('name', 'like', '%' . $search . '%')
                         ->orWhere('email', 'like', '%' . $search . '%');

        if ($sortBy == 'newest')
        {
            $comments = $comments->orderBy('created_at', 'desc');
        }

        if ($sortBy == 'latest')
        {
            $comments = $comments->orderBy('created_at', 'asc');
        }

        if ($sortBy == 'a-z')
        {
            $comments = $comments->orderBy('name', 'asc');
        }

        if ($sortBy == 'z-a')
        {
            $comments = $comments->orderBy('name', 'desc');
        }

        $comments = $comments->orderBy('created_at', 'desc')->paginate(10);

        return view('admins.comments.index', [
            'comments' => $comments,
            'total'  => $comments->total(),
            'perPage' => $comments->perPage(),
            'currentPage' => $comments->currentPage()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $news = News::all();
        return view('admins.comments.create', compact('news'));
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
            'name' => 'required|max:50',
            'email' => 'required|max:50',
            'comment_text' => 'required',
            'news_id' => 'required',
        ]);

        $comment = new Comment();
        $comment->name = $request->input('name');
        $comment->email = $request->input('email');
        $comment->comment_text = $request->input('comment_text');
        $comment->news_id = $request->get('news_id');
        $comment->save();

        toast('Data Has Been Added', 'success');
        return redirect()->route('admin.comment.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comment = Comment::findOrFail($id);

        return view('admins.comments.show', compact('comment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = News::all();
        $comment = Comment::findOrFail($id);

        return view('admins.comments.edit', compact('news', 'comment'));
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
            'name' => 'required|max:50',
            'email' => 'required|max:50',
            'comment_text' => 'required',
            'news_id' => 'required',
        ]);
        
        $comment = Comment::findOrFail($id);
        $comment->name = $request->input('name');
        $comment->email = $request->input('email');
        $comment->comment_text = $request->input('comment_text');
        $comment->news_id = $request->get('news_id');
        $comment->update();

        toast('Data Has Been Updated', 'success');
        return redirect()->route('admin.comment.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id)->delete();

        toast('Data Has Been Deleted', 'success');
        return redirect()->route('admin.comment.index');
    }
}
