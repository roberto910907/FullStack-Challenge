<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{
    public function list(): JsonResponse
    {
        //TODO: Fix this line to optimize the cache calls
        // $usersCacheKeys = User::query()->get('id')->map(fn(User $user) => 'weather:user:' . $user->id);
        //$usersData = Redis::connection('cache')->mget($usersCacheKeys);

        $usersWeatherData = User::query()->get('id')->map(fn(User $user) => Cache::get('weather:user:' . $user->id));

        return response()->json([
            'users' => $usersWeatherData,
        ]);
    }
}
