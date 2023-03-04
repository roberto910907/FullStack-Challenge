<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function list(): JsonResponse
    {
        return response()->json([
            'message' => 'all systems are a go',
            'users' => User::query()->with('weatherForecast')->get(),
        ]);
    }
}
