<?php

declare(strict_types=1);

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserWeatherUpdated implements ShouldBroadcast
{
    public function __construct(public User $user)
    {
        //...
    }

    public function broadcastOn(): Channel
    {
        return new Channel('weather-channel');
    }

    public function broadcastAs(): string
    {
        return 'weather.updated.'.$this->user->id;
    }

    public function broadcastWith(): array
    {
        return [
            'id' => $this->user->id,
            'name' => $this->user->name,
            'email' => $this->user->email,
            'weather' => $this->user->weatherForecast()->first()->toArray(),
        ];
    }
}
