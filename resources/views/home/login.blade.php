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
                <div class="">
                    @if(session()->has('error'))
                        <h5 class="text-danger">If you have not account yet you must create <br> account! <a href="{{url('user/store-page')}}">Register</a> click here</h5>
                    @endif    
                </div>
                <form action="{{url('user/reset')}}" class="form-register" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="mt-3">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email">
                        @error('email')
                           <h6 class="text-danger">{{$message}}</h6>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password">
                        @error('password')
                            <h6 class="text-danger">{{$message}}</h6>
                            
                        @enderror
                        @if(session()->has('error'))
                            <a class="text-primary" href="{{url('reset_password')}}">Forgot password</a> 
                        @endif  
                    </div>
                    <div>
                        <input type="submit" class="btn btn-primary mt-3" value="Login" id="">
                    </div>
                </form>
            </div>
        </div>
    @include('layout.footer')
</body>
</html>