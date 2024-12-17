<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'comment_text',
        'user_id',
        'post_id',
        'reply_id' 
    ];

    public function reply() 
    {
        return $this->hasOne(Comment::class, 'id', 'reply_id');
    }

    public function user() 
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
