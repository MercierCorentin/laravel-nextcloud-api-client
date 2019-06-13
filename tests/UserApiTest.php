<?php
namespace MercierCorentin\Nextcloud\Test;

use MercierCorentin\Nextcloud\User\UserApi;
Use MercierCorentin\Nextcloud\User\Status;

class UserApiTest extends TestCase
{


    /**
     * 
     * @return void
     * @dataProvider userProvider
     * @group creation
     */
    public function testCreateUser($userId, $userPass, $userDisplayName, $userEmail, $userGroups, $userSubAdminGroups, $userQuota, $language){
        $UserApi = new UserApi;
        $response = $UserApi->createUser($userId, $userPass, $userDisplayName, $userEmail, $userGroups, $userSubAdminGroups, $userQuota, $language);
        $this->assertContains($response["status"], [Status::CREATEUSER_OK, Status::CREATEUSER_EMAIL_NOT_SEND], $response['message']);
    }

    /**
     * @return void 
     * @group no_modif
     */
    public function testGetUserList(){
        $response = UserApi::getUserList("");
        $this->assertSame($this->userProvider(), $response["users"]);
    }
    

    public function userProvider(){
        return [
            "normal" => ["jpoulino", "", "Jean-Poux Lino", "jean-poux.lino@jjdu93.lino.com", [], [], "5GB", "fr"],
            "nopassword" => ["nopasswordmail", "", "No Pass Mail", "no-pass-mail@example.com", [], [], "1 Gb", ""],
        ];
    }
}