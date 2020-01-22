<?php

namespace App\Providers;

use App\Services\v1\impl\CabinetServiceImpl;
use App\Services\v1\impl\AuthServiceImpl;
use App\Services\v1\impl\CategoryServiceImpl;
use App\Services\v1\impl\CodeServiceImpl;
use App\Services\v1\impl\LevelServiceImpl;
use App\Services\v1\impl\MailServiceImpl;
use App\Services\v1\impl\SmsServiceImpl;
use App\Services\v1\impl\NewsServiceImpl;
use App\Services\v1\impl\BannerServiceImpl;
use App\Services\v1\impl\MeditationServiceImpl;
use App\Services\v1\impl\CourseServiceImpl;


use App\Services\v1\impl\StaticServiceImpl;
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

        $this->app->bind('App\Services\v1\MailService', function ($app) {
            return (new MailServiceImpl());
        });

        $this->app->bind('App\Services\v1\SmsService', function ($app) {
            return new SmsServiceImpl();
        });

        $this->app->bind('App\Services\v1\CodeService', function ($app) {
            return new CodeServiceImpl(new SmsServiceImpl(), new MailServiceImpl());
        });

        $this->app->bind('App\Services\v1\BannerService', function ($app) {
            return (new BannerServiceImpl());
        });

        $this->app->bind('App\Services\v1\StaticService', function ($app) {
            return (new StaticServiceImpl());
        });


//        $this ->app->bind('App\Services\v1\CabinetService',function ($app){
//           return (new CabinetServiceImpl());
//        });

        $this->app->bind('App\Services\v1\MeditationService', function ($app) {
            return (new MeditationServiceImpl());
        });

        $this->app->bind('App\Services\v1\CourseService', function ($app) {
            return (new CourseServiceImpl());

        });

        $this->app->bind('App\Services\v1\AuthService', function ($app) {
            return (new AuthServiceImpl());
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
