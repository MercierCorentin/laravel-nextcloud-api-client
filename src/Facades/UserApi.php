<?php
namespace MercierCorentin\Nextcloud\Facades;

use Illuminate\Support\Facades\Facade;


class UserApi extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'UserApi';
    }
}
