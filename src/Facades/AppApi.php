<?php
namespace MercierCorentin\Nextcloud\Facade;

use Illuminate\Support\Facades\Facade;


class AppApi extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'AppApi';
    }
}
