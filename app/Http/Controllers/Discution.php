<?php

namespace App\Http\Controllers;

use App\Models\Discution as ModelsDiscution;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Discution extends Controller
{
    public function getMydiscution()
    {
        $discutions = ModelsDiscution::where('user1', Auth::user()->id)
            ->orwhere('user2', Auth::user()->id)
            ->orderByDesc('created_at')
            ->get();
        $table_user = [];
        foreach ($discutions as $discution) {
            $last_messages = Message::where('discution_id', $discution->id)
                ->orderByDesc('created_at')
                ->take(1)
                ->get();
             $message_not_see=count(Message::where(['discution_id'=> $discution->id,'status'=>0,'to'=>Auth::user()->id])->get());
            if ($discution->user1 == Auth::user()->id) {
                $user = User::find($discution->user2);
                array_push($table_user, ['user' => $user, 'id_discution' => $discution->id, 'last_message' => $last_messages,'count_message'=>$message_not_see]);
            } else {
                $user = User::find($discution->user1);
                array_push($table_user, ['user' => $user, 'id_discution' => $discution->id, 'last_message' => $last_messages,'count_message'=>$message_not_see]);
            }
        }
        return $table_user;
    }

    public function add_new_discution($user_id){
       $is_on_discution=ModelsDiscution::where(['user1'=>Auth::user()->id,'user2'=>$user_id])->get();
       if(count($is_on_discution)==0){
        ModelsDiscution::create([
            'user1'=>Auth::user()->id,
            'user2'=>$user_id
        ]);
       }
        
       return ModelsDiscution::where(['user1'=>Auth::user()->id,'user2'=>$user_id])->get();
    }
}