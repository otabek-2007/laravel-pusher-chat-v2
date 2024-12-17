<?php
namespace App\Services;

use App\Models\Comment;

class CommentService
{
    public function store($data)
    {
    
        if(isset($data['comment_text'])){

            $comment = new Comment;
            $user_id = auth()->user()->id;
            $comment->user_id = $user_id;
            $comment->post_id = $data['post_id'];
            $comment->comment_text = $data['comment_text'];
            $comment->save(); 
        }
 
    }
}