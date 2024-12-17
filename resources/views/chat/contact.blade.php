<!DOCTYPE html>
<html lang="en">

<head>
    <title>Chat Laravel Pusher | Edlin App</title>
    <link rel="icon" href="https://assets.edlin.app/favicon/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- JavaScript -->
    <script src="//js.pusher.com/3.0/pusher.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <!-- End JavaScript -->
    @include('layout.header')
    <!-- CSS -->
    <link rel="stylesheet" href="/style.css">
    {{-- <link rel="stylesheet" href="css/style.css"> --}}
    <!-- End CSS -->
    <style>
        .element {
            display: inline-flex;
            align-items: center;
        }

        i.fa-camera {
            margin: 10px;
            cursor: pointer;
            font-size: 30px;
        }

        .mess-content {
            height: 60vh;
            display: flex;
            overflow-x: scroll;
        }

        .messages {
            width: 100%
        }

        ::-webkit-scrollbar {
            width: 10px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            display: none
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #888;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        i:hover {
            opacity: 0.6;
        }

        .upload-input {
            display: none;
        }

        #audio-message {
            display: none
        }
    </style>

</head>

<body>
    @include('layout.header_area')
    <div class="col-12 container-contact" style="position: absolute; width:90%; height:90%; margin-top:10px">
        <div class="serach-contact-bar">
            {{-- @csrf --}}
            <input type="text" id="search" style="outline: none;border:1px solid black; padding:5px 10px; "
                name="search" value="{{ old('search-user') }}">
            <div class="show-find-user">
                <hr>
                <div id="show_find_users">
                    @if (isset($users))
                        <div class="no-active-contact">
                            @foreach ($users as $user)
                                <div style="display: flex; justify-content:column;">
                                    <a href={{ "/contact/contact-page/$user->id" }} style="text-decoration: none"
                                        class="text-success">{{ $user->name }}</a>
                                </div>
                                <hr>
                            @endforeach
                        </div>
                        {{-- media screen responsive active --}}
                        <div class="btn-group active-contact">
                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Contacts
                            </button>
                            <ul class="dropdown-menu col-12 p-2">
                                @foreach ($users as $user)
                                    <div style="display: flex; justify-content:column;">
                                        <a href={{ "/contact/contact-page/$user->id" }} style="text-decoration: none;"
                                            class="text-success col-12 user-contact-name">{{ $user->name }}</a>
                                    </div>
                                    <hr>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @if (isset($user_data))
            <div class="chat col-8">
                <!-- Header -->
                <div class="top about-send-user">
                    <div class="inside-about">
                        <img class="image"
                            src="{{ $user_data->image ? '/storage/images/' . $user_data->image : '/storage/noUser.jpg' }}"
                            alt="Avatar">
                        <div class="text">
                            <p>{{ $user_data->name }}</p>
                            <small>Online</small>
                        </div>
                    </div>
                </div>

                <div class="mess-content">
                    <div class="messages">
                        
                        @if (!count($chat_message))
                            <div class="sms">
                                <div class="message">
                                </div>
                            </div>
                        @endif
                        @foreach ($chat_message as $sms)
                            @if ($sms->from_user_id == auth()->user()->id)
                                <div class="sms"
                                    style="display: flex; justify-content: right; flex-direction: column; ">
                                    @include('chat.broadcast', ['message' => $sms->sms])
                                </div>
                            @else
                                <div class="sms" style="display: flex; justify-content:left; flex-direction:column">
                                    @include('chat.receive', ['message' => $sms->sms])
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <!-- End Chat -->

                <!-- Footer -->
                {{-- <input type="file" > --}}
                <div class="bottom">
                    <form id="message-form" class="" enctype="multipart/form-data"
                        style="display:flex; flex-direction:row;">
                        <div class="col-12">

                            <input type="text" id="message" style="width: 90%; outline:none" name="message"
                                placeholder="Enter message..." autocomplete="off">
                            <input type="text" hidden value="{{ $user_data->id }}" name="user_id" id="user_id"
                                id="">
                            <button type="submit" style="border: 0px; color:blue;" class="submit-message"></button>
                        </div>
                    </form>
                </div>
                <audio src="/music/message.mp3" controls id="audio-message">
                    <embed src="/music/message.mp3" width="300" height="90" loop="false" autostart="false">
                </audio>
            @else
                <div style="text-align:center; width:50%; margin-top:40px">
                    {{-- <h6 class="text-primary">{{$error}}</h6>     --}}
                </div>
        @endif
    </div>
    <!-- End Footer -->


</body>
@include('layout.footer')
<script>
    const pusher = new Pusher('{{ config('broadcasting.connections.pusher.key') }}', {
        cluster: 'ap2'
    });
    const channel = pusher.subscribe('public');
    channel.bind('chat', function(data) {
        $.post("/contact/receive", {
                _token: '{{ csrf_token() }}',
                message: data.message,
                user_id: data.user_id,
            })
            .done(function(res) {
                $(".messages > .sms .message").last().after(res);
                $(document).scrollTop($(document).height());
            });
    });

    let audio = document.getElementById('audio-message');
    $("#message-form").submit(function(event) {
        event.preventDefault();

        $.ajax({
                url: "/contact/broadcast",
                method: 'POST',
                headers: {
                    'X-Socket-Id': pusher.connection.socket_id
                },
                data: {
                    _token: '{{ csrf_token() }}',
                    message: $("form #message").val(),
                    user_id: $("form #user_id").val(),
                }
            })
            .done(function(res) {
                audio.play();
                $(".messages > .sms .message").last().after(res);
                $("form #message").val('');
                $(document).scrollTop($(document).height());
            });
    });


    $(document).ready(function() {
        $('#search').on('keyup', debounce(() => {
            var query = $("#search").val();
            $.ajax({
                url: "/contact/contact-page",
                method: "GET",
                data: {
                    'search': query
                },
                success: function(data) {
                    $('#show_find_users').html(data)
                }
            });
        }));

    });

    function debounce(func, timeout = 500) {
        let timer;
        return (...args) => {
            clearTimeout(timer);
            timer = setTimeout(() => {
                func.apply(this, args);
            }, timeout);
        };
    }
</script>

</html>
