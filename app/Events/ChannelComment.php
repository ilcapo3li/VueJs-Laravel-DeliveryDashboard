<?php

namespace App\Events;

use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ChannelComment  implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    private $channel_id,$user,$comment;
    public function __construct($channel_id,User $user,$comment)
    {
        $this->channel_id=$channel_id;
        $this->user=$user;
        $this->comment=$comment;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('channel.'.$this->channel_id);
    }
    public function broadcastWith(){
        return [
            'comment'=>$this->comment,
            'user'=>$this->user->load('photo'),
            'channel'=>\App\Channel::find($this->channel_id)
        ];
    }
}
