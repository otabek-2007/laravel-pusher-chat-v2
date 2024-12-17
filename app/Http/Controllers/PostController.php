<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\User;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function storeView(){
        return view('home.create_post');
    }
    public function editView($id){
        $edit_post = Post::find($id);
        return view('home.edit', compact('edit_post'));
    }
    public function edit(PostRequest $request, $id){        

        $post = (new PostService)->edit($request->all(), $id);
        return redirect('/index');
    }
    
    public function delete($id){
        $post = Post::find($id)->delete();

        return redirect()->to('/index');
    }
    public function store(PostRequest $request){
        // dd($request);
        $post = (new PostService)->store($request->all());
        return redirect()->back();
    }
}
