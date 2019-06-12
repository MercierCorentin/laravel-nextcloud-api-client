<?php
namespace MercierCorentin\Nextcloud\Test;
use MercierCorentin\Nextcloud\Facades;
use MercierCorentin\Nextcloud\Providers;

use MercierCorentin\Nextcloud\Test\TestCase as NextcloudTestCase;

class TestCase extends NextcloudTestCase
{

    protected function getPackageProviders($app)
    {
        return [
            Providers\UserApiServiceProvider::class,
            Providers\GroupApiServiceProvider::class,
            Providers\AppApiServiceProvider::class
        ];
    }
    /**
     * Load package alias
     * @param  \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageAliases($app)
    {
        return [
            'UserApi' => Facades\UserApi::class,
            'GroupApi' => Facades\GroupApi::class,
            'AppApi' => Facades\AppApi::class
        ];
    }
}