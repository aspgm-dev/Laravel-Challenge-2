<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function get_comment($id)
    {
        return Comment::where('news_id', $id)->get();
    }

    public function count_comment($id)
    {
        return Comment::where('news_id', $id)->count();
    }

    public function post_comment(Request $request)
    {
        return Comment::create($request->all());
    }
}