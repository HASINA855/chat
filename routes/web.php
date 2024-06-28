<?php

use App\Events\ListeDiscutionEvent;
use App\Events\PlaygroundEvent;
use App\Events\ProcessingMessage;
use App\Events\TestEventes;
use App\Http\Controllers\Discution as ControllersDiscution;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\MessageControll;
use App\Http\Controllers\MessageController;
use App\Models\Discution;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('playground', function () {
    event(new PlaygroundEvent());
    return null;
});
Route::get('socket', function () {
    return view('webSocket');
});

// Route::get('message', function () {
//     return view('message');
// });

Route::post('_', [MessageController::class, 'send']);
Route::get('discution', function () {
    return view('discution');
});
Route::get('message/{id_discution}/{id_user}', function ($id_discution, $id_user) {

    $profile=User::find($id_user);
    return view('listeMessage', ['id_discution' => $id_discution, 'user_id' => $id_user, 'profile' => $profile]);
});
Route::get('connexion', function () {
    return view('connexion');
});
Route::post('Se_connecter', function (Request $request) {
    // return Hash::make('aaaaaaaa');
    if (
        Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])
    ) {
        return response()->json(['success' => 1]);
    } else {
        return response()->json(['error' => 0]);
    }
});

Route::get('getMydiscution', [ControllersDiscution::class, 'getMydiscution']);
Route::post('send__message', [MessageControll::class, 'send__message']);
Route::get('deconnexion', function () {
    Auth::logout();
    return redirect('/connexion');
});
Route::get('inscription', [InscriptionController::class, 'index']);
Route::post('createUser', [InscriptionController::class, 'store']);
Route::get('searchDiscution/{data}', [InscriptionController::class, 'searchDiscution']);
Route::get('resultDiscution/{data}', function ($data) {
    return view('resultDiscution', ['data' => $data]);
});

// gett message with id_discution

Route::get('show__message/{id_discution}', [MessageControll::class, 'show__message']);

// load liste discution
Route::get('liste0fdiscution', function () {
    return view('listeDiscution');
});

// update status message

Route::get('updateStatusMessage/{id_discution}', function ($id_discution) {
    Message::where(['discution_id' => $id_discution, 'to' => Auth::user()->id])->update([
        'status' => 1,
    ]);
});

// processing message
Route::get('listen_processing_message/{id_discution}', function ($id_discution) {
    $event = new ProcessingMessage($id_discution);
    broadcast($event)->toOthers();
});

Route::get('audio', function () {
    return view('audio');
});

Route::post('store_audio', function (Request $request) {
   if($file=$request->file('audio')){
    $file_name=md5(rand(1000,10000));
    $new_file=$file_name.'.'.$file->extension();

    $file->move(public_path('audios'),$new_file);
   }
   return "success";
});

Route::get('count_my_message',[MessageControll::class,'count_my_message']);
Route::get('listeMyMessage',function(){
    return view('navbar');
});

Route::get('get_images_messages/{id_discution}',[MessageControll::class,'get_images_messages']);


// suppression message
Route::get('delete_message/{id_user}/{id_message}',[MessageControll::class,'delete_message']);

// share message

Route::get('get_user_to_share',[MessageControll::class,'get_user_to_share']);
Route::post('send_multiple_message',[MessageControll::class,'send_multiple_message']);

Route::get('partage/{id_msg}/{id_discution}/{id_user}',function($id_msg,$id_discution,$id_user){

    $message=Message::find($id_msg);
    return view('shareMessage',['message'=>$message,'id_discution'=>$id_discution,'id_user'=>$id_user]);
});

Route::get('searchMessage/{id_discution}/{data}',[MessageControll::class,'searchMessage']);
Route::get('search_user_to_share/{data}',[MessageControll::class,'search_user_to_share']);