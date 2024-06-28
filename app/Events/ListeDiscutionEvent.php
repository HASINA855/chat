<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ListeDiscutionEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */

   protected $id_discution;
   protected $message;
   protected $id_chatWith;
    public function __construct($message, $id_discution,$id_chatWith)
    {
      $this->message=$message;
      $this->id_discution=$id_discution;
      $this->id_chatWith=$id_chatWith;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('listeDiscution-'.$this->id_discution),
        ];
    }

    public function broadcastAs(){
        return 'listeOfdiscution';
    }

    public function broadcastWith(){
        return  [
            'message'=>$this->message,
            'id_chatWith'=> $this->id_chatWith
        ];
    }
}