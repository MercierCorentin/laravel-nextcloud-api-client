<?php
namespace MercierCorentin\Nextcloud\Facade;

use Illuminate\Support\Facades\Facade;


class UserApi extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'UserApi';
    }
}
