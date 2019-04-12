<?php
namespace MercierCorentin\Nextcloud\Facades;

use Illuminate\Support\Facades\Facade;


class AppApi extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'AppApi';
    }
}
