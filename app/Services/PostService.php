<?php

namespace App\Services;

use App\Models\Post;
use Faker\Core\File;
use Illuminate\Support\Facades\File as FacadesFile;

class PostService
{
    public function store($data)
    {
        $data['user_id'] = auth()->user()->id;
        if(isset($data['image'])){
            $fileName = time().'.'.$data['image']->getClientOriginalExtension();
            $data['image']->storeAs('/posts_images', $fileName, 'public');
            $data['image'] = $fileName;
        }
        $post = Post::create($data);
    }

    public function edit($data, $id)
    {
        $editData = Post::find($id);
        $editData['title'] = $data['title'];
        $editData['body'] = $data['body'];
        if(isset($data['image']))
        {
            FacadesFile::delete(public_path('storage/posts_images/'.$editData['image']));
            $imagename = time().'.'.$data['image']->getClientOriginalExtension();
            $data['image']->storeAs('/posts_images', $imagename, 'public');
            $data['image'] = $imagename;
            $editData['image'] = $data['image'];

        }
        $editObj = $editData->save();
    }
}