<?php

declare(strict_types=1);

namespace App\Jobs;

use Exception;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use App\Services\WeatherForecastService;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateUserWeatherJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(private readonly User $user)
    {
        // ...
    }

    /**
     * @throws Exception
     */
    public function handle(WeatherForecastService $weatherForecastService): void
    {
        $weatherForecastService->updateWeather($this->user);
    }
}
