<?php
namespace MercierCorentin\Nextcloud\Providers;

use MercierCorentin\Nextcloud\User\UserApi;
use Illuminate\Support\ServiceProvider;

class UserApiServiceProvider extends ServiceProvider
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
        $this->app->singleton('UserApi',function(){
            return new UserApi();
        });
    }
}
