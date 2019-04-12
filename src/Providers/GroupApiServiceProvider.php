<?php
namespace MercierCorentin\Nextcloud\Providers;

use MercierCorentin\Nextcloud\Group\GroupApi;
use Illuminate\Support\ServiceProvider;

class GroupApiServiceProvider extends ServiceProvider
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
        $this->app->singleton('GroupApi',function(){
            return new GroupApi();
        });
    }
}
