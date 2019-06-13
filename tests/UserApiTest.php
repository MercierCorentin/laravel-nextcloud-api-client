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
        $UserApi = new UserApi;
        $response = $UserApi->getUserList("");

        $expectedUsers = ["admin"];
        foreach ($this->userProvider() as $element) {
            array_push($expectedUsers, $element[0]);
        }
        
        $this->assertSame($expectedUsers, $response["users"]);
    }
    

    public function userProvider(){
        return [
            "normal" => ["jpoulino", "j3\$bgn7è", "Jean-Poux Lino", "corentin.mercier@etu.utc.fr", [], [], "5GB", "fr"],
            "nopassword" => ["nopasswordmail", "", "No Pass Mail", "cocomercier24@gmail.com", [], [], "1 Gb", ""],
        ];
    }
}