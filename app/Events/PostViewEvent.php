<?php

namespace App\Events;

use App\Model\Post;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PostViewEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $ip;
    public $post;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Post $post,$ip)
    {
        $this->post=$post;
        $this->ip=$ip;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
