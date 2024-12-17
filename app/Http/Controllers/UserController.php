<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    public function storeView()
    {
        return view('home.register');
    }

    public function store(UserRequest $request)
    {
        $user = (new UserService())->updateOrCreate($request->all());
        return redirect('/index');
    }
    public function update($id, UserRequest $request)
    {   
        // return  dd($id);
        $user = (new UserService())->updateOrCreate($request->all(), $id);
        return redirect('/index');
    }

    public function login()
    {
        return view('home.login'); 
    }

    public function reset(UserRequest $request)
    {
        $login = (new UserService())->login($request->all());
        // return redirect('/index');
        return $login;
    }   
    public function profile($id){
        $user = auth()->user();
        return view('home.profile', compact('user'));
    }
    public function logout()
    {
        auth()->logout();
        return redirect('/index');
    }
}
