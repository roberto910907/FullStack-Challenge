<?php

declare(strict_types=1);

namespace App\Services;

use Exception;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use App\Repositories\WeatherForecastRepository;

class WeatherForecastService
{
    public function __construct(private readonly WeatherForecastRepository $weatherForecastRepository)
    {
        //...
    }

    /**
     * @throws Exception
     */
    public function updateWeather(User $user): void
    {
        $weatherForecastInfo = $this->retrieveWeatherInfo($user);

        $this->weatherForecastRepository->updateOrCreateFromArray($user->id, $weatherForecastInfo);
    }

    /**
     * @throws Exception
     */
    public function retrieveWeatherInfo(User $user): array
    {
        $weatherApiUrl = $this->getWeatherApiUrl($user->latitude, $user->longitude);

        $response = Http::get($weatherApiUrl);

        if ($response->ok()) {
            $weatherInfo = $response->json();

            return $weatherInfo['current'];
        } else {
            throw new Exception('Failed to retrieve weather information from '.$weatherApiUrl);
        }
    }

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
