<?php

namespace App\Providers;

use App\Rules\CategoryExists;
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
        $this->app->bind(CategoryExists::class, CategoryExists::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
