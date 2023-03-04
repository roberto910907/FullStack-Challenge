<?php

declare(strict_types=1);

namespace App\Services;

use Exception;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\WeatherForecast;
use Illuminate\Support\Facades\Http;

class WeatherForecastService
{
    /**
     * @param User $user
     *
     * @throws Exception
     */
    public function updateWeather(User $user): void
    {
        $weatherApiUrl = $this->getWeatherApiUrl($user->latitude, $user->longitude);

        $response = Http::get($weatherApiUrl);

        if ($response->ok()) {
            $weatherInfo = $response->json();
            $weatherForecast = $weatherInfo['current'];

            if ($weatherForecast) {
                WeatherForecast::query()->updateOrCreate(
                    [
                        'temperature' => $weatherForecast['temp'],
                        'pressure' => $weatherForecast['pressure'],
                        'humidity' => $weatherForecast['humidity'],
                        'clouds' => $weatherForecast['clouds'],
                        'wind_speed' => $weatherForecast['wind_speed'],
                        'condition_name' => $weatherForecast['weather'][0]['main'],
                        'description' => $weatherForecast['weather'][0]['description'],
                    ],
                    ['user_id' => $user->id]
                );
            }
        } else {
            throw new Exception('Failed to retrieve weather information from ' . $weatherApiUrl);
        }
    }

    /**
     * @param string $latitude
     * @param string $longitude
     *
     * @return string
     */
    private function getWeatherApiUrl(string $latitude, string $longitude): string
    {
        return Str::swap([
            '{lat}' => $latitude,
            '{lon}' => $longitude,
            '{part}' => 'hourly,daily',
            '{api_key}' => config('weather.api.key'),
        ], config('weather.api.url'));
    }
}
