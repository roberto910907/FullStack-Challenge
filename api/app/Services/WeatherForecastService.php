<?php

declare(strict_types=1);

namespace App\Services;

use Exception;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
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
        $weatherForecastInfo = $this->retrieveWeatherInfoFromApi($user);

        $this->updateUserWeatherCache($user->id, $user->name, $weatherForecastInfo);

        $this->weatherForecastRepository->updateOrCreateFromArray($user->id, $weatherForecastInfo);
    }

    /**
     * @throws Exception
     */
    public function retrieveWeatherInfoFromApi(User $user): array
    {
        $weatherApiUrl = $this->getWeatherApiUrl($user->latitude, $user->longitude);

        $response = Http::get($weatherApiUrl);

        if ($response->ok()) {
            $weatherInfo = $response->json();

            $weatherForecastInfo = $weatherInfo['current'];

            return [
                'temperature' => $weatherForecastInfo['temp'],
                'pressure' => $weatherForecastInfo['pressure'],
                'humidity' => $weatherForecastInfo['humidity'],
                'clouds' => $weatherForecastInfo['clouds'],
                'wind_speed' => $weatherForecastInfo['wind_speed'],
                'condition_name' => $weatherForecastInfo['weather'][0]['main'],
                'description' => $weatherForecastInfo['weather'][0]['description'],
            ];
        } else {
            throw new Exception('Failed to retrieve weather information from ' . $weatherApiUrl);
        }
    }

    /**
     * @param int $userId
     * @param string $userName
     * @param array $weatherForecastInfo
     */
    public function updateUserWeatherCache(int $userId, string $userName, array $weatherForecastInfo): void
    {
        Cache::rememberForever("weather:user:${userId}", function () use ($userId, $userName, $weatherForecastInfo) {
            return [
                'id' => $userId,
                'name' => $userName,
                'weather' => $weatherForecastInfo,
            ];
        });
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
