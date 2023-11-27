<?php

namespace App\Providers;

use App\Repositories\SupportEloquentORM;
use App\Repositories\SupportRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(SupportRepositoryInterface::class, SupportEloquentORM::class);
    }

    public function boot(): void
    {
    }
}
