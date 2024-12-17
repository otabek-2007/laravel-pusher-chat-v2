<!DOCTYPE html>
<html lang="en">
<head>
    @include('layout.header')
    <style>

        .create_post input{
            border: 0px;
            outline: none;
            padding: 10px 20px;
        }
        .create_post textarea{
            outline: none;
            border: 0px;
            padding: 0px 20px;
        }
        .create_post label{
            font-size: 15px;
            margin:10px 0px 0px 0px
        }
        .container-form{
            background-color:rgb(182, 181, 181); 
            /* border: 3px solid black; */
            padding: 30px
        }
    </style>
</head>
<body>
    @include('layout.header_area')
        <div class="container-fluid" style="display: flex; justify-content:center; margin-bottom:20px">
            <div style="width:80%; display:flex; justify-content:center">
                <div class="col-6 container-form">
                    <div style="display: flex; flex-direction:row; justify-content:space-between">
                        <h5 style="font-family: sans-serif">Edit Your Post</h5>
                        <a style="margin-left:10px; text-decoration:none" href="{{url('post/show-details', $edit_post->id)}}">
                            <i style="font-size: 15px; color:blue" class="fa fa-light fa-eye"></i>
                            Show Post
                        </a>
                        <a style="font-family: sans-serif; font-size:20px; text-decoration:none" href="/index" class="text-success">Home <i class="fa-solid fa-house"></i></a>
                    </div>
                    <form action="{{url('post/edit', $edit_post->id)}}" method="POST" class="create_post" style="display: flex; flex-direction:column" enctype="multipart/form-data">
                        @csrf
                        <label for="">Title</label>
                        <input type="text" name="title" value="{{$edit_post->title}}">
                        @error('title')
                            <h5 style="font-size: 15px" class="text-danger">{{$message}}</h5>
                        @enderror
                        <label for="">Body</label>
                        <textarea name="body" id="" cols="30" rows="10">{{$edit_post->body}}</textarea>
                        @error('body')
                            <h5 style="font-size: 15px" class="text-danger">{{$message}}</h5>
                        @enderror
                        <input type="text" name="user_id" hidden>
                        <label for="">Image</label>
                        <img src="{{ $edit_post->image ? "/storage/posts_images/$edit_post->image" : '/storage/noImage.png' }}" height="250px"  style="object-fit: cover; border-radius:10px" class="card-img-top col-12" alt="...">


                        <input type="file" name="image" value="">
                        <input type="submit" class="btn btn-primary" value="Add Post">
                    </form>
                </div>
            </div>
        </div>
    @include('layout.footer')
</body>
</html>