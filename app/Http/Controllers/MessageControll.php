<?php

namespace App\Http\Controllers;

use App\Events\GetMessage;
use App\Events\ListenDiscution;
use App\Models\Discution;
use App\Models\Message;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Discution as ModelsDiscution;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class MessageControll extends Controller
{
    public function send__message(Request $request)
    {
        if (!$request->file('img_message') && !$request->message && !$request->file('voice_message')) {
            return 'error';
        } else {
            $images = [];
            if ($files = $request->file('img_message')) {
                foreach ($files as $file) {
                    $image_name = md5(rand(1000, 10000));
                    $fileName = $image_name . '.' . $file->extension();
                    $file->move(public_path('message_photo'), $fileName);
                    array_push($images, $fileName);
                }
            } else {
                $images = [];
            }

            if ($request->message) {
                $message = $request->message;
            } else {
                $message = '';
            }

            if ($file = $request->file('voice_message')) {
                $file_name = md5(rand(1000, 10000));
                $voice_message = $file_name . '.' . $file->extension();
                $file->move(public_path('audios'), $voice_message);
            } else {
                $voice_message = '';
            }

            //  if(!$request->file('voice_message') || !$request->message || !$request->file('img_message')){
            //     return 'veuiller ecrire un message ou'
            //  }

            $id_discution = $request->id_discution;
            $id_chatWith = $request->id_user;

            // $date=date('y-m-d h:m:s');

            Discution::find($id_discution)->update([
                'created_at' => time(),
            ]);

            Message::create([
                'from' => Auth::user()->id,
                'to' => $id_chatWith,
                'message' => nl2br($message),
                'voice_message' => $voice_message,
                'images' => implode('|', $images),
                'discution_id' => $id_discution,
            ]);
            $event = new GetMessage($id_discution, $message, $voice_message, implode('|', $images));
            broadcast($event)->toOthers();
            $listen_discution = new ListenDiscution($id_chatWith);
            broadcast($listen_discution)->toOthers();
        }
    }
    public function show__message($id_discution)
    {
        return Message::where('discution_id', $id_discution)->orderBy('created_at')->get();
    }

    public function count_my_message()
    {
        $messages_not_see = Message::where(['to' => Auth::user()->id, 'status' => 0])->get();

        $data = [];
        foreach ($messages_not_see as $message_not_see) {
            if (!in_array($message_not_see->discution_id, $data)) {
                array_push($data, $message_not_see->discution_id);
            }
        }
        return count($data);
    }

    public function get_images_messages($id_discution)
    {
        $datas = Message::where('discution_id', $id_discution)->where('images', '!=', '')->get();

        $images = [];
        foreach ($datas as $data) {
            if (strstr($data->images, '|') > -1) {
                $image_items = explode('|', $data->images);
                for ($i = 0; $i < count($image_items); $i++) {
                    array_push($images, $image_items[$i]);
                }
            } else {
                array_push($images, $data->images);
            }
        }

        return $images;
    }

    public function delete_message($id_user,$id_message)
    {
        Message::find($id_message)->delete();
        $listen_discution = new ListenDiscution($id_user);
        broadcast($listen_discution)->toOthers();
    }
    public function get_user_to_share()
    {
        $discutions = ModelsDiscution::where('user1', Auth::user()->id)
            ->orwhere('user2', Auth::user()->id)
            ->orderByDesc('created_at')
            ->get();
        $table_user = [];
        foreach ($discutions as $discution) {
            if ($discution->user1 == Auth::user()->id) {
                $user = User::find($discution->user2);
                array_push($table_user, ['user' => $user, 'id_discution' => $discution->id]);
            } else {
                $user = User::find($discution->user1);
                array_push($table_user, ['user' => $user, 'id_discution' => $discution->id]);
            }
        }
        return $table_user;
    }

    public function search_user_to_share($data)
    {
        $discutions = ModelsDiscution::where('user1', Auth::user()->id)
            ->orwhere('user2', Auth::user()->id)
            ->orderByDesc('created_at')
            ->get();
        $table_user = [];
        foreach ($discutions as $discution) {
            if ($discution->user1 == Auth::user()->id) {
                // $user = User::where('id',$discution->user2)->where('nom', 'like', "%$data%")->orwhere('prenom','like',"%$data%")->get();

              $user=  DB::select('select * from users where (nom like ? or prenom like ?) AND id=?',["%$data%","%$data%",$discution->user2]);
                if($user){
                    array_push($table_user, ['user' => $user, 'id_discution' => $discution->id]);
                }
                
            } else {
                // $user = User::where('id',$discution->user1)->where('nom', 'like', "%$data%")->orwhere('prenom','like',"%$data%")->get();
                $user=  DB::select('select * from users where (nom like ? or prenom like ?) AND id=?',["%$data%","%$data%",$discution->user2]);
                if($user){
                    array_push($table_user, ['user' => $user, 'id_discution' => $discution->id]); 
                }
               
            }
        }
        return $table_user;
    }

    public function send_multiple_message(Request $request)
    {
        // return $request->all();
        if ($request->voice != '') {
            $voice = $request->voice;
        } else {
            $voice = '';
        }
        if ($request->image != '') {
            $image = $request->image;
        } else {
            $image = '';
        }
        if ($request->message != '') {
            $message = $request->message;
        } else {
            $message = '';
        }

        Discution::find($request->multiple_id_discution)->update([
            'created_at' => time(),
        ]);

        Message::create([
            'from' => Auth::user()->id,
            'to' => $request->id_users,
            'message' => $message,
            'voice_message' => $voice,
            'images' => $image,
            'discution_id' => $request->multiple_id_discution,
        ]);

        $event = new GetMessage($request->multiple_id_discution, $message, $voice, $image);
        broadcast($event)->toOthers();
        $listen_discution = new ListenDiscution($request->id_users);
        broadcast($listen_discution)->toOthers();

        return response()->json(['success' => 'Message partager avec success']);
    }

    public function searchMessage($id_discution, $data)
    {
        $serach_message = Message::where('discution_id', $id_discution)
            ->where('message', 'like', "%$data%")
            ->get();
        return $serach_message;
    }
}