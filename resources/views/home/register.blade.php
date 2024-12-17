<!DOCTYPE html>
<html lang="en">
    <base href="/public">
    @include('layout.header')
    <style>
        .form-register div{
            display: flex; 
            flex-direction: column
        }
        .form-register input{
            width: 400px;
            border: 0px;
            outline: 0px;
            padding: 5px
        }
        .row-inbox{
            background-color: rgb(218, 222, 236);
            padding: 30px
        }
    </style>

<body>
    @include('layout.header_area')
        <div class="container" style="display: flex; justify-content:center;">
            <div class="row-inbox">
                <form action="{{url('user/store')}}" class="form-register" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="mt-3">
                        <label for="name">Name</label>
                        <input type="text" id="name" value="{{old('name')}}" name="name">
                        @error('name')
                           <h6 class="text-danger">{{$message}}</h6>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label for="username">Username</label>
                        <input type="text" id="username" value="{{old('username')}}" name="username">
                        @error('username')
                            <h6 class="text-danger">{{$message}}</h6>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label for="email">Email</label>
                        <input type="email" id="email" value="{{old('email')}}" name="email">
                        @error('email')
                            <h6 class="text-danger">{{$message}}</h6>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label for="phone">phone</label>
                        <input type="number" id="phone" value="{{old('phone')}}" name="phone">
                        @error('phone')
                            <h6 class="text-danger">{{$message}}</h6>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password">
                        @error('password')
                            <h6 class="text-danger">{{$message}}</h6>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="confirm_password" id="confirm_password" name="confirm_password">
                        @error('confirm_password')
                            <h6 class="text-danger">{{$message}}</h6>
                        @enderror
                    </div>
                    <div>
                        <label for="img">Image</label>
                        <input type="file" name="image" value="image">
                    </div>
                    <div>
                        <input type="submit" class="btn btn-primary mt-3" value="register" id="">
                    </div>
                </form>
            </div>
        </div>
    @include('layout.footer')
</body>
</html>