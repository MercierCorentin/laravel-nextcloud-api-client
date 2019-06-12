<?php
namespace MercierCorentin\Nextcloud\Test;

use MercierCorentin\Nextcloud\User\UserApi;
Use MercierCorentin\Nextcloud\User\Status;

class UserApiTest extends TestCase
{


    /**
     * 
     * @return void
     */
    public function testCreateUser($user)
    {
        $response = UserApi::createUser($user[0], $user[1], $user[2], $user[3], $user[4], $user[5], $user[6], $user[7]);
        // Fixing master...
        // $this->assertContains($response["status"], [Status::CREATEUSER_OK, Status::])
        // UserApi->createUser($user);
    }

    public function userProvider(){
        return [
            ["jpoulino", "\$up3R\$t0nG_P455W0rd", "Jean-Poux Lino", "jean-poux.lino@jjdu93.lino.com", [], [], "5GB", "fr"],
            ["nopasswordmail", "", "No Pass Mail", "no-pass-mail@example.com", [], [], "1 kb", ""],
        ];
    }
}