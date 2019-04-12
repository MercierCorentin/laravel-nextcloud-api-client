# Laravel Nextcloud API User Management
Manage your nextcloud users via laravel for 16.0

Forked from [MasterZero/laravel-nextcloud-user-management](https://github.com/MasterZero/laravel-nextcloud-user-management) to add more options in the user creation, to add features and for Nextcloud 16 version. 

# Setup:
1. Use following command in your terminal to install this library. (Currently the library is in development mode):

    `composer require MercierCorentin/nextcloud dev-master`

2. Update the poviders in config/app.php
        
        'providers' => [
            // ...
            MercierCorentin\Nextcloud\ApiServiceProvider::class,
        ]

3. Update the aliases in config/app.php

        'aliases' => [
            // ...
            'NextcloudApi' => MercierCorentin\Nextcloud\Facade\Api::class,
        ]

4. Create `config/nextcloud.php` with content:

```php

return [
    'login'=> env('NEXTCLOUD_LOGIN', 'admin'),
    'password'=> env('NEXTCLOUD_PASSWORD', '12345678'),
    'baseUrl'=> env('NEXTCLOUD_BASEURL', 'http://localhost'),
];

```

5. Add these params to `.env` (recommended):

```sh
NEXTCLOUD_LOGIN=admin
NEXTCLOUD_PASSWORD=12345678
NEXTCLOUD_BASEURL=http://localhost

```

# Usage:
### create user:
```php
// full options
NextcloudApi::createUser($username, $password, $displayName, $email, $groups, $subadmin, $quota, $language);
```
### Resend welcome email
```php
NextcloudApi::welcome($username);
```
### User list:
```php
NextcloudApi::getUserList();
```

### Edit user param:
```php
// reqeust to API
NextcloudApi::editUser($username,$key,$value);
```
Possible keys:
- email
- quota
- displayname
- phone
- address
- website
- twitter
- password


### Enable/disable user:
```php
// Enable
NextcloudApi::enableUser('username');
// Diable
NextcloudApi::disableUser('username');
```

# Exceptions

```php

use MasterZero\Nextcloud\Exceptions\XMLParseException;
use MasterZero\Nextcloud\Exceptions\CurlException;

// ... 

try {
    // reqeust to API
    NextcloudApi::editUser('rabbit','quota', '200 MB');
} catch (XMLParseException $e) {
    // bad nextcloud answer
} catch (CurlException $e) {
    // bad connection
} catch (\Exception $e) {
    // bad something else
}

```


# multi-server usage

```php

use MasterZero\Nextcloud\Api;

// ... 

$api = new Api([
    'baseUrl' => 'http://develop.localhost:3500',
    'login' => 'admin',
    'password' => '12345678',
    'sslVerify' => false,


    // use default value
    // 'apiPath' => 'custom/path/to/api.php', 
    // 'userPath' => '',
    // 'enablePath' => '',
    // 'disablePath' => '',
]);


$api->createUser( 'dummy', 'qwerty');

```
# To do 
- Add groups management