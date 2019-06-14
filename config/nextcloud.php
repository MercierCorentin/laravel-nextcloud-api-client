<?php

    return [ 
        "nextcloud" => [
            'login'     => env('NEXTCLOUD_LOGIN', ''),
            'password'  => env('NEXTCLOUD_PASSWORD', ''),
            'baseUrl'   => env('NEXTCLOUD_BASEURL', ''),
        ]
    ];