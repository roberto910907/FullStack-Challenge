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

    /**
     * @return Channel
    */
    public function broadcastOn(): Channel
    {
        return new Channel('weather-channel');
    }

    /**
     * @return string
     */
    public function broadcastAs(): string
    {
        return 'weather.updated.' . $this->user->id;
    }

    /**
     * @return array
     */
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
