<!DOCTYPE html>
<html lang="en">
    <base href="/public">
    @include('layout.header')
<body>
    @include('layout.header_area')
    @include('layout.footer_area')
    <div class="container-fluid index-container" style="display: flex; justify-content:center">
        <div class="row" style="width: 90%;">
            
            @foreach ($posts as $post)
                <div class="card">
                    <img src="{{ $post->post_image ? "storage/posts_images/$post->post_image" : 'storage/noImage.png' }}"  style="object-fit: cover; border-radius:10px" class="card-img-top col-12" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{$post->title}}</h5>
                        <p class="card-text">{{$post->body}}</p>
                        @if(auth()->user())
                            @if(auth()->user()->id == $post->user_id)
                                <div style="display: inline-flex; justify-content:space-around;" class="btn-box-crud">
                                    <a href="{{url('post/edit-view', $post->post_id)}}" class="btn btn-success" style="margin-right: 10px">Edit</a>
                                    <form action="{{url("post/delete", $post->post_id)}}" method="post">
                                        @csrf
                                        <input type="submit" class="btn btn-danger" value="delete">
                                    </form>
                                </div>
                                {{-- @else  --}}
                                
                            @endif
                        @endif
                        <a style="float: right" class="eye-show-icon"  href="{{url('post/show-details', $post->post_id)}}">
                            <i style="color:blue; font-size:20px; margin-top:10px" class=" fa fa-light fa-eye"></i>
                        </a>
                    </div>
                    <div class="bottom-card" style="display: inline-flex; justify-content:space-around">
                        <h6 style="font-size: 12px">Created at by: {{$post->name}}</h6>
                        <h6 style="font-size: 12px">{{date('H:m a', strtotime($post->created_at))}}</h6>
                    </div>
                </div>
            @endforeach
            @if(auth()->user())
                <div class="card" style="background-color:rgb(143, 182, 233); border:0px; " >
                    <a href="{{url('post/store-view')}}" style="width: 100%; text-decoration:none; height:100%; display:flex; justify-content:center; align-items:center">
                        <div style="text-align:center">
                            <div>
                                <h5 style="font-size: 30px">Add Post</h5>
                            </div>
                            <div>
                                <i style="font-size: 40px" class="fa-solid fa-plus"></i>
                            </div>
                        </div>
                    </a>
                </div>
            @endif    
        </div>
    </div>
    @include('layout.footer')
    
</body>
</html>