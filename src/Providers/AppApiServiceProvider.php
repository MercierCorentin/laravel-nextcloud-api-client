<?php
namespace MercierCorentin\Nextcloud\Providers;

use MercierCorentin\Nextcloud\App\AppApi;
use Illuminate\Support\ServiceProvider;

class AppApiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('AppApi',function(){
            return new AppApi();
        });
    }
}
