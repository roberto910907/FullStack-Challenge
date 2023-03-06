<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{
    public function list(): JsonResponse
    {
        $usersWeatherData = User::query()->get('id')->mapWithKeys(function (User $user) {
            return [$user->id => Cache::get('weather:user:' . $user->id)];
        });

        return response()->json([
            'users' => $usersWeatherData,
        ]);
    }
}
