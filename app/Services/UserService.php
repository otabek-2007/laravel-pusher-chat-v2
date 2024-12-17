<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService  
{

    public function updateOrCreate($data, $id = null) 
    {
        
        if(isset($data['image'])) 
        {
            $fileName = time().'.'.$data['image']->getClientOriginalExtension();
            $data['image']->storeAs('images', $fileName, 'public');
            $data['password'] = Hash::make(request()->password);
            $data['image'] = $fileName;
        }
        
        $user = User::updateOrCreate(['id' => $id ], $data);
        
        auth()->login($user);
        // login user
        return $user;
    }
    
    public function login($data) 
    {
        $data_collect = collect($data)->only(['email', 'password'])->toArray();

        if (Auth::attempt($data_collect)) {
            session()->regenerate();
            return redirect()->to('/index');
        } else{
            // dd('dw');
            return redirect()->back()->with('error', 'dew');
        }
    }
}