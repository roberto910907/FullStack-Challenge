<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property float $temperature
 * @property float $pressure
 * @property float $humidity
 * @property float $clouds
 * @property float $wind_speed
 * @property string weather_icon
 * @property string $condition_name
 * @property string $description
 */
class WeatherForecast extends Model
{
    use HasFactory;

    protected $fillable = [
        'temperature',
        'pressure',
        'humidity',
        'clouds',
        'wind_speed',
        'weather_icon',
        'condition_name',
        'description',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
