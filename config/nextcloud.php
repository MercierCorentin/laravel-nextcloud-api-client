<?php

    return [ 
        "nextcloud" => [
            'login'     => env('NEXTCLOUD_LOGIN', 'admin'),
            'password'  => env('NEXTCLOUD_PASSWORD', 'password'),
            'baseUrl'   => env('NEXTCLOUD_BASEURL', 'https://cloud.test.picasoft.net'),
        ]
    ];