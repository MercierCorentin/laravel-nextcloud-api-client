<?php
namespace MercierCorentin\Nextcloud\Facade;

use Illuminate\Support\Facades\Facade;


class GroupApi extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'GroupApi';
    }
}
