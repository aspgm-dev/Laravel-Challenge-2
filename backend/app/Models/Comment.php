<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'name', 'email', 'comment_text', 'news_id'
    ];

    public function news()
    {
        return $this->hasOne('\App\Models\News', 'id', 'news_id');
    }
}
