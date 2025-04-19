<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Processors\InputProcessorFactory;
use App\Processors\InputProcessorFactoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(InputProcessorFactoryInterface::class, InputProcessorFactory::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
