<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\WeatherForecast;
use Illuminate\Database\Eloquent\Builder;

class WeatherForecastRepository
{
    public function updateOrCreateFromArray(int $userId, array $weatherForecastInfo): WeatherForecast|Builder
    {
        return WeatherForecast::query()->updateOrCreate($weatherForecastInfo, ['user_id' => $userId]);
    }
}
