<?php
namespace MercierCorentin\Nextcloud\App;

use MercierCorentin\Nextcloud\Exceptions\XMLParseException;

/**
* class MercierCorentin\Nextcloud\Response
* statuses for nextcloud response
*/
abstract class Status
{
    /**
     * Getlist app
     */
    const GETLIST_APP_OK                = 100; // successful
    const GETLIST_APP_INVALID_INPUT     = 101; // invalid input data

    /**
     * Get app info
     */
    const GET_INFO_APP_OK               = 100; // successful

     /**
      * Enable App
      */
    const ENABLE_APP_OK                 = 100; // successful

    /**
     * Disable app
     */
    const DISABLE_APP_OK                 = 100; // successful


}