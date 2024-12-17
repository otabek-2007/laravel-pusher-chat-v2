<!DOCTYPE html>
<html lang="en">
<head>
    @include('layout.header')
    <style>

        .create_post input{
            outline: none;
            border: 0px;
            padding: 10px 20px;
        }
        .create_post textarea{
            display: flex;
            outline: none;
            text-align: left
        }
        .create_post label{
            font-size: 15px;
            margin:10px 0px 0px 0px
        }
    
    </style>
</head>
<body>
    @include('layout.header_area')
        <div class="container-fluid" style="display: flex; justify-content:center">
            <div class="create-post-box" style="display:flex; justify-content:center">
                <div class="container-form">
                    <div class="text-create-post">
                        <h5 style="font-family: sans-serif">Create Your Post</h5>
                        <a style="font-family: sans-serif; text-decoration:none" href="/index" class="text-success">Home <i class="fa-solid fa-house"></i></a>
                    </div>
                    <form action="{{url('post/store')}}" method="POST" class="create_post" style="display: flex; flex-direction:column" enctype="multipart/form-data">
                        @csrf
                        <label for="">Title</label>
                        <input type="text" name="title">
                        @error('title')
                            <h5 style="font-size: 15px" class="text-danger">{{$message}}</h5>
                        @enderror
                        <label for="">Body</label>
                        <textarea name="body" id="" style="padding: 5px 10px" cols="30" rows="10"></textarea>
                        @error('body')
                            <h5 class="text-danger" style="font-size: 15px">{{$message}}</h5>
                        @enderror
                        <input type="text" name="user_id" hidden>
                        <label for="">Image</label>
                        <input type="file" name="image" value="image">
                        <input type="submit" class="btn btn-primary add-post" value="Add Post">
                    </form>
                </div>
            </div>
        </div>
    @include('layout.footer')
</body>
</html>