<?php

namespace App\Http\Controllers;

use App\Events\MessageEvent;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function send(Request $request){
       event(new MessageEvent($request->message));
       return null;
    }
}