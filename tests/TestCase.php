<?php
namespace MercierCorentin\Nextcloud\Test;
use MercierCorentin\Nextcloud\Facades;
use MercierCorentin\Nextcloud\User\UserApi;
use MercierCorentin\Nextcloud\App\AppApi;
use MercierCorentin\Nextcloud\Group\GroupApi;
use MercierCorentin\Nextcloud\Providers;


class TestCase extends \Orchestra\Testbench\TestCase
{
    public $UserApi;
    public $GroupApi;
    public $AppApi;
    /**
     * Setup the test environment.
     */
    public function setUp() : void
    {
        parent::setUp();
        config(require("./config/nextcloud.php"));
        $this->UserApi = new UserApi;
        $this->GroupApi = new GroupApi;
        $this->AppApi = new AppApi;
    }
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