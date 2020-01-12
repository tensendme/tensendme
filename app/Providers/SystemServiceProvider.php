<?php

namespace App\Providers;

use App\Services\v1\impl\CategoryServiceImpl;
use App\Services\v1\impl\LevelServiceImpl;
use App\Services\v1\impl\NewsServiceImpl;

use Illuminate\Support\ServiceProvider;

class SystemServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Services\v1\CategoryService', function ($app) {
            return new CategoryServiceImpl();
        });

        $this->app->bind('App\Services\v1\LevelService', function ($app) {
            return new LevelServiceImpl();
        });

        $this->app->bind('App\Services\v1\NewsService', function ($app) {
            return new NewsServiceImpl();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
