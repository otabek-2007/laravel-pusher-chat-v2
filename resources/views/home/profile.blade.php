<!DOCTYPE html>
<html lang="en">
<head>
 @include('layout.header')
 <style>
    .modal-body input{
        /* outline: none; */
        color: rgb(86, 86, 255);
        border: 0px;
        padding: 10px 5px;
    }
 </style>
</head>
<body>
    @include('layout.header_area')
        <div class="container-fluid profile-container" style="display: flex; justify-content:center;">
            <div style="width: 80%; margin-top:50px">
                <div class="profile-content">
                    <div class="user-text col-6">
                        <h5>User Name: <span class="text-primary">{{$user->name}}</span></h5>
                        <hr>
                        <h5>Username: <span class="text-primary">{{$user->username}}</span></h5>
                        <hr>
                        <h5>User Email: <span class="text-primary">{{$user->email}}</span></h5>
                        <hr>
                        <h5>User Phone Number: <span class="text-primary">{{$user->phone}}</span></h5>
                    </div>
                    <div class="user-image col-6">
                        {{-- <div class="col-12" style=""> --}}
                            <img class="image" src="{{$user->image != null ? '/storage/images/'.$user->image : "/storage/noUser.jpg" }}"  style="border:solid 3px black; padding:20px; object-fit:cover;" alt="">
                        {{-- </div> --}}
                    </div>
                </div>
                <div class="crud">
                    <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Edit <i class="fas fa-pen" style="margin-left: 10px; font-size:15px"></i>
                    </button>  
                </div>
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Edit Your Account</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ url("/user/edit/" . $user->id) }}" enctype="multipart/form-data" method="POST">
                                @csrf
                                @method("PUT")
                                <div class="modal-body" style="display: flex; flex-direction:column">
                                  <label for="">Name:</label>
                                  <input type="text" name="name"  value="{{$user->name}}">
                                  <label for="">Email:</label>
                                  <input type="text" name="email" value="{{$user->email}}">
                                  <label for="">Username:</label>
                                  <input type="text" name="username" value="{{$user->username}}">
                                  <label for="">Phone Number:</label>
                                  <input type="text" name="phone" value="{{$user->phone}}">
                                  <label for="">Password:</label>
                                  <input type="text" name="password" value="">
                                  <label for="">Confirm Password:</label>
                                  <input type="text" name="confirm_password" >
                                </div>
                                <div class="modal-footer">
                                    <input type="submit" value="Edit" class="btn btn-secondary" data-bs-dismiss="modal">
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @include('layout.footer')
</body>
</html>