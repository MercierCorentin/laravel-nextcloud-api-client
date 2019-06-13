<?php
namespace MercierCorentin\Nextcloud\Test;

Use MercierCorentin\Nextcloud\User\Status;

class UserApiTest extends TestCase
{

    /**
     * Tests user creation on normal conditions
     * @return void
     * @dataProvider userProvider
     * @group creation
     */
    public function testCreateUserSuccess($userId, $userPass, $userDisplayName, $userEmail, $userGroups, $userSubAdminGroups, $userQuota, $language){
        $response = $this->UserApi->createUser($userId, $userPass, $userDisplayName, $userEmail, $userGroups, $userSubAdminGroups, $userQuota, $language);
        $this->assertContains($response["status"], [Status::CREATEUSER_OK, Status::CREATEUSER_EMAIL_NOT_SEND], $response['message']);
    }

    /**
     * Tests user creation when username already exists
     * @return void
     * @dataProvider userProvider
     * @group creation
     */
    public function testCreateUserAlreadyExists($userId, $userPass, $userDisplayName, $userEmail, $userGroups, $userSubAdminGroups, $userQuota, $language){
        $response = $this->UserApi->createUser($userId, $userPass, $userDisplayName, $userEmail, $userGroups, $userSubAdminGroups, $userQuota, $language);
        $this->assertEquals($response["status"], Status::CREATEUSER_EXIST, $response['message']);
    }

    /**
     * Tests groups retrievement
     * @return void 
     * @group no_modif
     */
    public function testGetUserList(){
        $response = $this->UserApi->getUserList("");

        $expectedUsers = ["admin"];
        foreach ($this->userProvider() as $element) {
            array_push($expectedUsers, $element[0]);
        }
        
        $this->assertSame($expectedUsers, $response["users"]);
    }

    /**
     * Tests user details retrieving
     * @return void
     * @group no_modif
     * @dataProvider userProvider
     */
    public function testGetUserDetails($userId, $userPass, $userDisplayName, $userEmail, $userGroups, $userSubAdminGroups, $userQuota, $language){
        $response = $this->UserApi->getUserInfos($userId);
        $this->assertTrue($response['success']);
        $this->assertEquals($response["infos"]["email"], $userEmail);
    }

    /**
     * Tests user details retrieving when user doesn't exist
     * @return void
     * @group no_modif
     * @dataProvider userProvider
     */
    public function testNonExistGetUserDetails($userId, $userPass, $userDisplayName, $userEmail, $userGroups, $userSubAdminGroups, $userQuota, $language){
        $response = $this->UserApi->getUserInfos($userId."nonExist");
        $this->assertTrue($response['status']===Status::USERINFOS_NOT_FOUND, $response["message"]);
    }

    /**
     * Tests user info edition
     * @return void
     * @group modif
     * @dataProvider userProvider
     */
    public function testEditUser($userId, $userPass, $userDisplayName, $userEmail, $userGroups, $userSubAdminGroups, $userQuota, $language){
        $response = $this->UserApi->editUser($userId, "displayname", "TestDisplayName");
        $this->assertTrue($response["success"]);
    }

    /**
     * Tests disable user fonctionality
     * @return void
     * @group modif
     * @dataProvider userProvider
     */
    public function testDisableUser($userId, $userPass, $userDisplayName, $userEmail, $userGroups, $userSubAdminGroups, $userQuota, $language){
        $response = $this->UserApi->disableUser($userId);
        $this->assertTrue($response["success"]);
    }
    
    /**
     * Tests enable user fonctionality
     * @return void
     * @group modif
     * @dataProvider userProvider
     */
    public function testEnableUser($userId, $userPass, $userDisplayName, $userEmail, $userGroups, $userSubAdminGroups, $userQuota, $language){
        $response = $this->UserApi->enableUser($userId);
        $this->assertTrue($response["success"]);
    }
    
    /**
     * Tests user deletion
     * @return void
     * @group delete
     * @dataProvider userProvider
    */
    public function testDeleteUser($userId, $userPass, $userDisplayName, $userEmail, $userGroups, $userSubAdminGroups, $userQuota, $language){
        $response = $this->UserApi->deleteUser($userId);
        $this->assertTrue($response["success"]);
    }

    /**
     * Tests non-existant user deletion
     * @return void
     * @group delete
     * @dataProvider userProvider
    */
    public function testNonExistDeleteUser($userId, $userPass, $userDisplayName, $userEmail, $userGroups, $userSubAdminGroups, $userQuota, $language){
        $response = $this->UserApi->deleteUser($userId);
        $this->assertTrue($response["status"] === Status::DELETEUSER_FAILURE);
    }

    public function userProvider(){
        return [
            "normal" => ["jpoulino", "j3\$bgn7è", "Jean-Poux Lino", "jean-poux.lino@example.com", [], [], "5GB", "fr"],
            "nopassword" => ["nopasswordmail", "", "No Pass Mail", "nopasswordmail@example.com", [], [], "1 Gb", ""],
        ];
    }
}