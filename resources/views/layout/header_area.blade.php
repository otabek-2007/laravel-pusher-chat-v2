<!DOCTYPE html>
<html lang="en">
  @include('layout.header')
<body>
    <!-- As a link -->
    <nav class="navbar navbar-light navbar-header">
        <div class="container navbar-container">
            <div class="row container">
                <div class="col-4">
                    <a class="navbar-brand text-success" style="font-weight:bolder" href="/index"><i class="fas fa-home" style="letter-spacing: 5px">Z.Chat</i></a>
                </div>
                {{-- {{auth()->user()->id}} --}}
                <div class="col-8" id="header-main">
                  @if(auth()->user())
                    <div class="col-12 navbar-header">
                        <a href="{{"/user/profile/".auth()->user()->id}}" class="profile-image">
                          <img class="" src="{{ auth()->user()->image ? '/storage/images/'.auth()->user()->image : '/storage/noUser.jpg' }}" width="40px" height="40px
                          " style="border-radius: 50%; margin-right:20px; object-fit:cover;" alt="">
                        </a>
                          
                          <div class="dropdown header-dropdown">
                            <button class="btn btn-secondary dropdown-toggle" style="display: inline-flex;
                            align-items: center;" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                              <h4 class="name-of-profile">{{auth()->user()->name}}</h4>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <h6 style="text-align:center; background-color:gray; padding:10px 0px">User</h6>
                              <li><a class="dropdown-item" href="{{url('user/profile', auth()->user()->id)}}">Profile</a></li>
                              <li><a class="dropdown-item" href="{{url('user/logout')}}">Logout</a></li>
                            </ul>
                          </div>
                    </div> 
                  @else  
                    <div class="col-12 navbar-header">
                        <a href="{{url('user/login')}}" class="btn btn-primary">Login</a>
                        <a href="{{url('user/store-page')}}" class="btn btn-success">Register</a>
                    </div>
                  @endif
                </div>
            </div>
        </div>
    </nav>    
    {{-- canvas left navbar --}}
    <a class="btn btn-primary mt-4" id="open-left-bar" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
        <i class="fa-solid fa-right-long"></i>
      </a>
      
      
      <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
          <a class="navbar-brand text-success" style="font-weight:bolder" href="/index"><i class="fas fa-home" style="letter-spacing: 5px">Z.Chat</i></a>

          <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <div>
            {{-- Some text as placeholder. In real life you can have the elements you have chosen. Like, text, images, lists, etc. --}}
          </div>
          <div class="dropdown mt-3">
            <nav class="navbar-left">
              @if(auth()->user())
                <ul>
                  <li><a class="mt-2 text-success" href="{{url("about")}}">About Us</a></li>
                  <hr>
                  <li><a class="mt-2" href="{{url("post/store-view")}}">Add Post</a></li>
                  <hr>
                  <li><a class="mt-2" href="{{url("contact/contact-page")}}">Contacts</a></li>
                  <hr>
                  {{-- <li><a class="mt-2" href=""></a></li> --}}
                </ul>
              @else
                  <h4>Welcome to my project !!! :)</h4>
              @endif
            </nav>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              {{-- <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li> --}}
            </ul>
          </div>
        </div>
        <div class="offcanvas-footer col-12" style="display:flex;  justify-content:right">
          <div class="p-4">
            @if(auth()->user())
              <a href="{{url('/user/logout')}}" class="p-3" style="font-size:20px; float:right; text-decoration: none; padding:20px 0px;">Logout <i class="fa-solid fa-right-from-bracket""></i></a>
            @endif
          </div>
        </div>
      </div>
      

</body>
</html>