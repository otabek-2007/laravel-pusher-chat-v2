<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function about(){
        return view('home.about');
    }
    public function index()
    {
        $posts = DB::select('select *, posts.id as post_id, posts.image as post_image from posts left join users on posts.user_id = users.id');

        return view('home.index', compact('posts'));
    }
    public function showDetails($id)
    {
        $comments = Comment::with([
            'reply' => function($query) {
                $query->select('id', 'user_id','comment_text');
                $query->with('user:id,name');
            },
            'user:id,name'
        ])
            ->get()->toArray();
        // dd($comments);
        // foreach ($comments as $key => $comment) {
        //     dd($comment['reply']);
        // }

        $post = DB::select("select *, posts.id as post_id, posts.image as post_image from posts left join users on posts.user_id = users.id where posts.id = " . $id);

        return view('home.show_details', compact('post', 'id', 'comments'));
    }
}
