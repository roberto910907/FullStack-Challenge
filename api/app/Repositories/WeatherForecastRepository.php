<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\WeatherForecast;
use Illuminate\Database\Eloquent\Builder;

class WeatherForecastRepository
{
    public function updateOrCreateFromArray(int $userId, array $weatherForecastInfo): WeatherForecast|Builder
    {
        return WeatherForecast::query()
            ->updateOrCreate(
                [
                    'temperature' => $weatherForecastInfo['temp'],
                    'pressure' => $weatherForecastInfo['pressure'],
                    'humidity' => $weatherForecastInfo['humidity'],
                    'clouds' => $weatherForecastInfo['clouds'],
                    'wind_speed' => $weatherForecastInfo['wind_speed'],
                    'condition_name' => $weatherForecastInfo['weather'][0]['main'],
                    'description' => $weatherForecastInfo['weather'][0]['description'],
                ],
                ['user_id' => $userId]
            );
    }
}
