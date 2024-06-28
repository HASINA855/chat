<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class GetMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    protected $id_discution;
    protected $message;
    protected $voice_message;
    protected $images;
    public function __construct($id_discution,$message,$voice_message,$images)
    {
        //
        $this->id_discution=$id_discution;
        $this->message=$message;
        $this->voice_message=$voice_message;
        $this->images=$images;
        
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('getMessage.'.$this->id_discution),
        ];
    }
    public function broadcastAs(){
        return 'GetMessage';
    }

    public function broadcastWith(){
        return  [
            'message'=>$this->message,
            'id_chatWith'=> $this->id_discution,
            'voice_message'=>$this->voice_message,
            'images'=>$this->images
        ];
    }
}