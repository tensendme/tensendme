<?php

namespace App\Providers;

use App\Services\v1\impl\AuthServiceImpl;
use App\Services\v1\impl\BannerServiceImpl;
use App\Services\v1\impl\CategoryServiceImpl;
use App\Services\v1\impl\CloudPaymentServiceImpl;
use App\Services\v1\impl\CodeServiceImpl;
use App\Services\v1\impl\CourseServiceImpl;
use App\Services\v1\impl\FileServiceImpl;
use App\Services\v1\impl\FollowerServiceImpl;
use App\Services\v1\impl\HistoryServiceImpl;
use App\Services\v1\impl\LevelServiceImpl;
use App\Services\v1\impl\MailServiceImpl;
use App\Services\v1\impl\MaterialServiceImpl;
use App\Services\v1\impl\MeditationServiceImpl;
use App\Services\v1\impl\NewsServiceImpl;
use App\Services\v1\impl\PassingServiceImpl;
use App\Services\v1\impl\ProfileServiceImpl;
use App\Services\v1\impl\PromoCodeAnalyticServiceImpl;
use App\Services\v1\impl\PushServiceImpl;
use App\Services\v1\impl\RatingServiceImpl;
use App\Services\v1\impl\SmsServiceImpl;
use App\Services\v1\impl\StaticServiceImpl;
use App\Services\v1\impl\SubscriptionServiceImpl;
use App\Services\v1\impl\WithdrawalServiceImpl;
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

        $this->app->bind('App\Services\v1\FileService', function ($app) {
            return (new FileServiceImpl());
        });

        $this->app->bind('App\Services\v1\MaterialService', function ($app) {
            return (new MaterialServiceImpl());
        });

        $this->app->bind('App\Services\v1\SubscriptionService', function ($app) {
            return (new SubscriptionServiceImpl(new HistoryServiceImpl(new PromoCodeAnalyticServiceImpl(), new LevelServiceImpl())));
        });
        $this->app->bind('App\Services\v1\PaymentService', function ($app) {
            return (new CloudPaymentServiceImpl(new SubscriptionServiceImpl(new HistoryServiceImpl(
                new PromoCodeAnalyticServiceImpl(), new LevelServiceImpl()))));
        });
        $this->app->bind('App\Services\v1\HistoryService', function ($app) {
            return (new HistoryServiceImpl(new PromoCodeAnalyticServiceImpl(), new LevelServiceImpl()));
        });
        $this->app->bind('App\Services\v1\WithdrawalRequestService', function ($app) {
            return (new WithdrawalServiceImpl(new HistoryServiceImpl(new PromoCodeAnalyticServiceImpl(), new LevelServiceImpl()),
                new PushServiceImpl()));
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
            return (new AuthServiceImpl(new SubscriptionServiceImpl(new HistoryServiceImpl(
                new PromoCodeAnalyticServiceImpl(), new LevelServiceImpl())), new FollowerServiceImpl(
                new HistoryServiceImpl(new PromoCodeAnalyticServiceImpl(), new LevelServiceImpl()), new PromoCodeAnalyticServiceImpl()
            )));
        });

        $this->app->bind('App\Services\v1\RatingService', function ($app) {
            return (new RatingServiceImpl());
        });

        $this->app->bind('App\Services\v1\FollowerService', function ($app) {
            return (new FollowerServiceImpl(new HistoryServiceImpl(new PromoCodeAnalyticServiceImpl(), new LevelServiceImpl()),
                new PromoCodeAnalyticServiceImpl()));
        });

        $this->app->bind('App\Services\v1\ProfileService', function ($app) {
            return (new ProfileServiceImpl(new FileServiceImpl(), new RatingServiceImpl()));
        });

        $this->app->bind('App\Services\v1\PromoCodeAnalyticService', function ($app) {
            return (new PromoCodeAnalyticServiceImpl());
        });

        $this->app->bind('App\Services\v1\PushService', function ($app) {
            return (new PushServiceImpl());
        });

        $this->app->bind('App\Services\v1\PassingService', function ($app) {
            return (new PassingServiceImpl());
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
