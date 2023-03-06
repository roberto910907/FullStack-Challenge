<?php

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use App\Services\WeatherForecastService;

test('Update weather user cache', function () {
    $user = User::factory()->create(['name' => 'Roberto']);
    $mock = mock(WeatherForecastService::class)->makePartial();

    Cache::shouldReceive('forget')
        ->once()
        ->with("weather:user:" . $user->id)
        ->andReturn(true);

    $weatherForecastInfo = ['description' => 'cloudy'];

    Cache::shouldReceive('rememberForever')
        ->once()
        ->with("weather:user:" . $user->id, function () use ($user, $weatherForecastInfo) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'weather' => $weatherForecastInfo,
            ];
        })
        ->andReturn([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'weather' => $weatherForecastInfo,
        ]);

    $mock->updateUserWeatherCache($user, $weatherForecastInfo);

    expect(Cache::get("weather:user:" . $user->id))->toBe([
        'id' => $user->id,
        'name' => $user->name,
        'email' => $user->email,
        'weather' => ['description' => 'cloudy'],
    ]);
});

test('Weather api url', function () {
    $mock = mock(WeatherForecastService::class)->makePartial();

    expect($mock->getWeatherApiUrl('-10.12322', '15.1945'))->toBe('http://test-api.test/onecall?lat=-10.12322&lon=15.1945&exclude=hourly,daily&appid=18272&units=imperial');
});
