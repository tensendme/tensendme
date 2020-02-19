<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    protected $namespaceAPI_V1 = 'App\Http\Controllers\Api\V1';
    protected $namespaceAPI_V2 = 'App\Http\Controllers\Api\V2';

    protected const WEB_ADMIN_PREFIX = '\Web\v1\Admin';
    protected const WEB_CONTENT_MANAGER_PREFIX = '\Web\v1\Admin';
    protected const WEB_ACCOUNTANT_PREFIX = '\Web\v1\Admin';



    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiV1Routes();

        $this->mapApiV2Routes();

        $this->mapWebRoutes();

        $this->mapWebAdminRoutes();

        $this->mapWebContentManagerRoutes();

        $this->mapWebAccountantRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    protected function mapWebAdminRoutes()
    {
        Route::middleware(['web', 'auth', 'ROLE_ADMIN'])
            ->namespace($this->namespace . RouteServiceProvider::WEB_ADMIN_PREFIX)
            ->group(base_path('routes/web/web_admin.php'));
    }

    protected function mapWebContentManagerRoutes()
    {
        Route::middleware(['web', 'auth', 'ROLE_CONTENT_MANAGER'])
            ->namespace($this->namespace . RouteServiceProvider::WEB_CONTENT_MANAGER_PREFIX)
            ->group(base_path('routes/web/web_content_manager.php'));
    }

    protected function mapWebAccountantRoutes()
    {
        Route::middleware(['web', 'auth', 'ROLE_ACCOUNTANT'])
            ->namespace($this->namespace . RouteServiceProvider::WEB_ACCOUNTANT_PREFIX)
            ->group(base_path('routes/web/web_accountant.php'));
    }
    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiV1Routes()
    {
        Route::prefix('api/v1')
            ->middleware('api')
            ->namespace($this->namespaceAPI_V1)
            ->group(base_path('routes/api/v1/api.php'));
    }


    protected function mapApiV2Routes()
    {
        Route::prefix('api/v2')
            ->middleware('api')
            ->namespace($this->namespaceAPI_V2)
            ->group(base_path('routes/api/v2/api.php'));
    }
}
