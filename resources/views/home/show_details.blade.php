<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @include('layout.header')
</head>

<body>
    @include('layout.header_area')
    <div class="container" style="display: flex; justify-content:center;">
        <div class="content" style="width: 80%">
            <div style="display: flex; flex-direction:row; justify-content:space-between">
                <h5 style="font-family: sans-serif">Show The Details Of Post</h5>
                <a style="font-family: sans-serif; font-size:20px; text-decoration:none" href="/index"
                    class="text-success">Home <i class="fa-solid fa-house"></i></a>
            </div>
            <div class="show-box"
                style="width:100%; padding:10px 20px;  border-radius:10px; background-color:rgb(207, 203, 197)">
                @foreach ($post as $item)
                    <div style="display: flex; justify-content:space-between" class="show">
                        <div class="data-text">
                            <h5 class="mt-3" style="text-align: center;">{{ $item->title }}</h5>
                            <hr style="color: black">
                            <h5 class="mt-3">{{ $item->body }}</h5>
                            @if (auth()->user())
                                @if (auth()->user()->id == $item->user_id)
                                    <div style="display: inline-flex; justify-content:space-around;">
                                        <a href="{{ url('post/edit-view', $item->post_id) }}" class="btn btn-success"
                                            style="margin-right: 10px">Edit</a>
                                        <form action="{{ url('post/delete', $item->post_id) }}" method="post">
                                            @csrf
                                            <input type="submit" class="btn btn-danger" value="delete">
                                        </form>
                                    </div>
                                @endif
                            @endif
                        </div>
                        <div class="data-image">
                            <img src="{{ $item->post_image ? "/storage/posts_images/$item->post_image" : '/storage/noImage.png' }}"
                                height="250px" style="object-fit: cover; border-radius:10px" class="card-img-top col-12"
                                alt="...">
                        </div>
                    </div>
                @endforeach
            </div>
            <hr style="height:2px; margin-top:30px;">
            <div class="comment-box">
                <div class="read-comment">
                    <div class="read-box">
                        @if (!empty('comments'))
                            @foreach ($comments as $comment)
                                {{-- {{$comment['reply']}} --}}
                                @if ($comment['user']['id'] == auth()->user()->id)
                                    <div class="alert alert-primary my_comment_hover" role="alert" id="comment-box-{{$comment['id']}}">
                                        <h5 style="font-size: 15px" class="text-primary mt-2">From by: <span
                                                class="text-success">{{ $comment['user']['name'] }}</span></h5>
                                        @if ($comment['reply'] != null)
                                            <div class="alert alert-secondary mt-4">
                                                <h6 class="text-dark"><span class="text-success">Reply to:</span>
                                                    <p>{{ $comment['reply']['comment_text'] }}</p>
                                            </div>
                                        @else
                                            @if ($comment['reply_id'] == $comment['id'])
                                                <p>Reply to: deleted message</p>
                                            @endif
                                        @endif
                                        <div style="display: inline-flex;">
                                            <form action="{{ url('comment/update') }}" class="update_comment_form"
                                                method="post">
                                                @csrf
                                                <input class="bg-primary p-2 text-white my_edit_comment"
                                                    id="my_edit_comment" type="text"
                                                    style="outline: none; border:0px" disabled name=""
                                                    value="{{ $comment['comment_text'] }}"
                                                    data-id="{{ $comment['id'] }}">
                                                <input class="btn btn-info" type="submit" style="margin-top: 20px" id="edit_comment_submit"
                                                    class="edit_comment_submit" value="save"
                                                    data-id="{{ $comment['id'] }}">
                                            </form>
                                        </div>
                                        <div class=""
                                            style="right:0px; padding:10px; top:0px;position: absolute; display:inline-flex">
                                            <button type="submit" id="edit_btn" class="btn btn-primary edit_btn"
                                                data-id="{{ $comment['id'] }}">
                                                Edit
                                            </button>
                                            <form method="post" action="{{ url('comment/delete', $comment['id']) }}">
                                                @csrf
                                                <input type="submit" value="Delete" class="btn btn-danger">
                                            </form>
                                        </div>
                                    </div>
                                    {{-- edit comment modal --}}
                                    <!-- Button trigger modal -->
                                @else
                                    <div class="alert alert-secondary" role="alert">
                                        <h5 style="font-size: 15px" class="text-primary">From by: <span
                                                class="text-success">{{ $comment['user']['name'] }}</span></h5>

                                        @if ($comment['reply'] != null)
                                            {{-- @if ($comment['reply']['user']['name'] != null) --}}
                                            <div class="alert alert-info">

                                                <h6 class="text-dark"><span class="text-success">Reply to:</span>
                                                    {{ $comment['reply']['user']['name'] }}</h6>
                                                <p>{{ $comment['reply']['comment_text'] }}</p>
                                            </div>
                                        @else
                                            @if ($comment['reply_id'] == $comment['id'])
                                                <p>Reply to: deleted message</p>
                                            @endif
                                        @endif

                                        <div class="mt-4">
                                            <p class="bg-info p-2 text-white">{{ $comment['comment_text'] }}</p>
                                        </div>
                                        <div style="right:0px; padding:10px; top:0px;position: absolute;">
                                            <button type="submit" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#staticBackdrop">
                                                reply
                                            </button>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Reply to: <span
                                                            class="text-primary">{{ $comment['user']['name'] }}</span>
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ url('/comment/reply', $comment['id']) }}"
                                                    method="POST">
                                                    @csrf
                                                    <div class="modal-body"
                                                        style="display: flex; flex-direction:column">
                                                        <input type="text" value="{{ $id }}"
                                                            name="post_id" hidden>

                                                        <textarea style="padding: 10px" id="" name="comment_text" cols="30" rows="10"></textarea>
                                                        <input type="submit" style="width:100px"
                                                            class="btn btn-primary mt-3" value="Add reply">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                        <!-- Button trigger modal -->


                        <!-- Modal -->

                    </div>
                </div>
                @if (auth()->user())
                    <div class="col-12 write-comment"
                        style="display: flex; justify-content:center; margin-bottom:50px">
                        <form action="{{ url('comment/store') }}" class="col-12" method="POST"
                            style="display: flex; justify-content:center;">
                            @csrf
                            <input type="text" name="comment_text" class="col-5"
                                style="padding: 10px 5px; border:3px solid rgb(118, 173, 221); outline:none">
                            <input type="text" value="{{ $id }}" name="post_id" hidden>
                            <input type="submit" value="Comment"
                                style="  border-radius:0px;border-top-right-radius:  10px; border-bottom-right-radius:10px;"
                                class="btn btn-primary col-1">
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
    @include('layout.footer')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>


</body>
<script>
    let edit_comment = document.querySelectorAll('#my_edit_comment')
    let edit_submit = document.querySelectorAll('#edit_comment_submit')
    let edit_btns = document.querySelectorAll('#edit_btn');
    let ids = [];

    for (const edit_btn of edit_btns) {

        edit_btn.addEventListener('click', function(e) {
            for (const submit_btn of edit_submit) {
                ids.push(submit_btn.getAttribute('data-id'))
                if (ids.includes(e.target.getAttribute('data-id'))) {
                    if (submit_btn.getAttribute('data-id').includes(e.target.getAttribute('data-id'))) {
                        for (const edit_com of edit_comment) {
                            if (edit_com.getAttribute('data-id').includes(e.target.getAttribute('data-id'))) {
                                edit_com.disabled = false
                                submit_btn.style.display = 'flex';
                            }
                        }
                    }
                }
            }
        })
    }


    $(".update_comment_form").submit(function(event) {
        event.preventDefault();

        var form = $(this);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
                url: "/comment/update",
                method: 'POST',
                data: {
                    // _token: token,
                    id: form.find('#edit_comment_submit').attr('data-id'),
                    comment: form.find('.my_edit_comment').val(),
                }
            })
            .done(function(res) {
                if(res.deleted){
                    $('#comment-box-' + form.find('#edit_comment_submit').attr('data-id')).remove();
                }
                console.log(res);
            });
    });
</script>

</html>
