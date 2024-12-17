<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Reply;
use App\Services\CommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(CommentRequest $request)
    {
        $comment = (new CommentService)->store($request->all());
        return redirect()->back();
    }
    public function delete($id)
    {
        Comment::find($id)->delete();
        return redirect()->back()->with('deleted', 'message deleted !');
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'id' => ['required', 'exists:comments,id'],
            'comment' => ['string', 'nullable']
        ]);

        $update_comment = Comment::find($data['id']);
        if ($update_comment) {
            if ($data['comment'] != null) {
                $update_comment->comment_text = $data['comment'];
                $update_comment->save();
                return $data['comment'];
            } else {
                $update_comment->delete();
                return ['deleted' => true];
            }
        }

        return;
    }
    public function reply($id)
    {
        if (request()->comment_text) {

            $comment = new Comment;
            $user_id = auth()->user()->id;
            $comment->user_id = $user_id;
            $comment->post_id = request()->post_id;
            $comment->reply_id = $id;
            $comment->comment_text = request()->comment_text;
            $comment->save();
        }
        return redirect()->back();
    }
}
