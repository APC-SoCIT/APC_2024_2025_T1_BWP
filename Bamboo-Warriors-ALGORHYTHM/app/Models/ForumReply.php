<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumReply extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'forum_post_id', 'user_id'];

    // Define the inverse relationship with ForumPost
    public function post()
    {
        return $this->belongsTo(ForumPost::class, 'forum_post_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
