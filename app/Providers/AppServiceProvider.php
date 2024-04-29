<?php

namespace App\Providers;

use App\Models\Task;
use App\Observers\TaskObserver;
use App\Repositories\EloquentTaskRepository;
use App\Repositories\TaskRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(TaskRepositoryInterface::class, EloquentTaskRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Task::observe(TaskObserver::class);
    }
}
