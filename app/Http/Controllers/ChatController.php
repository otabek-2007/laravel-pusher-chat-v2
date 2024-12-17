<?php

namespace App\Http\Controllers;

use App\Events\PusherBroadcast;
use App\Http\Requests\ChatRequest;
use App\Models\Chat;
use App\Models\Reply;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public function contact($id = null)
    {
        // dd($id);
        $user_id = auth()->user()->id;
        $chat_user_ids = Chat::select(
            DB::raw("IF(from_user_id = " . auth()->user()->id . ", to_user_id, from_user_id) AS user_id")
            )
            ->where(function($query) {
                $query->where('from_user_id', auth()->user()->id);
                $query->orWhere('to_user_id', auth()->user()->id);
            })
            ->pluck('user_id')
            ->unique();
            
            $query = User::query();
            
        if (request()->ajax()) {

            if (request()->search) {
                $users = $query->where(function($q) {
                        $q->where('username', "LIKE", "%" . request()->search . "%");
                        $q->orWhere('name', "LIKE", "%" . request()->search . "%");
                    })->get();
            } else {
                $users = $query->whereIn('id', $chat_user_ids)->orderByDesc('id')->get();
            }

            $output = '';
            if (count($users) > 0) {
                foreach($users as $user) {
                    $output .="
                    <div>
                        <a style='text-decoration: none' href='/contact/contact-page/$user->id'>".$user->name.'</a>
                    </div>
                    <hr>
                    ';
                }    
            } else {
                return $output .='any user not found';
            }
            return $output;
        }
            
        $users = $query->whereIn('id', $chat_user_ids)->orderByDesc('id')->get();
        
        $user_data = User::where('id', $id)->first();
        // dd($user_data);
        $chat_message = Chat::whereIn("from_user_id", [$user_id, $id])
            ->whereIn('to_user_id', [$user_id, $id])->get();
        
        return view('chat.contact', compact('users', "chat_message", 'user_data'));
    }
 

    public function broadcast(Request $request)
    {
        // dd($request->get(file('upload_image')));
        if($request->get('message')){
            $chat = new Chat;
            $chat->from_user_id = auth()->user()->id;
            $chat->to_user_id = $request->get('user_id');
            $chat->sms = $request->get('message');
            $chat->save();
        }
        // broadcast(new PusherBroadcast($request->get('image')))->toOthers();
        broadcast(new PusherBroadcast($request->get('message')))->toOthers();
        
        return view('chat.broadcast', ['message' => $request->get('message')]);
    }

    
    public function receive(Request $request)
    {
        // dd($request);
        return view('chat.receive', ['message' => $request->get('message')]);
    }
}
