<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ForgotPassword
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $request,$content_mail;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($request,$content_mail)
    {
        $this->request = $request;

        $this->content_mail = $content_mail;

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return ['test'];
        //return new PrivateChannel('channel-name');
    }
}
