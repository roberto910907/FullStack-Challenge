<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WeatherForecast extends Model
{
    use HasFactory;

    protected $fillable = [
        'temperature',
        'pressure',
        'humidity',
        'clouds',
        'wind_speed',
        'condition_name',
        'description',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
