<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Tag;
use App\Models\News;
use App\Models\Comment;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index() 
    {
        $category = Category::count();
        $tag = Tag::count();
        $news = News::count();
        $comment = Comment::count();
        
        return view('admins.dashboard', compact(
            'category',
            'tag',
            'news',
            'comment'
        ));
    }
}
