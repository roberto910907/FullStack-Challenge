<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use App\Jobs\UpdateUserWeatherJob;
use Illuminate\Support\Collection;

class UpdateUserWeather extends Command
{
    public const USER_CHUNK_SIZE = 10;

    /**
     * @var string
     */
    protected $signature = 'weather:update';

    /**
     * @var string
     */
    protected $description = 'Update weather forecast for every existent user';

    public function handle(): int
    {
        $this->info('Starting weather forecast update process...');

        User::query()
            ->whereNotNull(['latitude', 'longitude'])
            ->chunk(self::USER_CHUNK_SIZE, function (Collection $users): void {
                $users->each(function (User $user) {
                    $this->newLine();
                    $this->info(sprintf('Queueing update weather process for user: ["%s"]', $user->name));

                    UpdateUserWeatherJob::dispatch($user);
                });
            });

        $this->newLine();
        $this->info('All update processes have been successfully sent to the queue!');

        return self::SUCCESS;
    }
}
