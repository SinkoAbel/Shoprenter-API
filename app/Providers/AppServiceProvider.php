<?php

namespace App\Providers;

use App\Http\Interfaces\IConvertable;
use App\Http\Services\DataConverter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IConvertable::class, function ($app) {
            return new DataConverter();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
