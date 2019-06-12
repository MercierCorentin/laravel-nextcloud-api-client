<?php
namespace MercierCorentin\Nextcloud\Test;

use MercierCorentin\Nextcloud\Group\GroupApi;
use MercierCorentin\Nextcloud\Group\Status;

class GroupApiTest extends TestCase
{

    private $groupIdRoot = "Test";
    
    private $groupNumber = 5;

    // Group creation tests need to be improved!

    /**
     * Check that the groups are created
     * @return void
     * @group creation
     * @dataProvider groupProvider
     */
    public function testCreateGroup($groupId){
        $response = GroupApi::createGroup($groupId);
        $this->assertEquals(Status::CREATEGROUP_OK, $response["status"]);
    }

    /**
     * @return void
     * @group no_modif
     * @dataProvider groupProvider
     */
    public function testCreateExistGroup($groupId){
        $response = GroupApi::createGroup($groupId);
        $this->assertEquals(Status::DELETEGROUP_EXIST, $response["status"]);
    }

    /**
     * @return void
     * @group no_Modif
     */
    public function testSearchGroupsAll(){
        $response = GroupApi::searchGroups($this->groupIdRoot);
        $this->assertTrue($response["success"]);
        $this->assertSame(
            $this->GroupProvider(),
            $response["groups"]
        );
    }

    /**
     * @return void
     * @dataProvider groupProvider
     * @group delete
     */
    public function testDeleteGroup($groupId){
        $response = GroupApi::deleteGroup($groupId);
        $this->assertTrue($response["success"]);
    }


    /**
     * @return void
     * @group no_modif
     */
    public function testGetGroupUsers(){

    }

    /**
     * @return void
     * @group no_modif
     */
    public function testGetGroupSubadmins(){

    }

    public function GroupProvider(){
        $groupIds = [];
        for ($i = 1; $i <= $this->groupNumber; $i++ ){ 
            array_push($groupIds, $this->groupIdRoot.$i );
        }
        return $groupIds;
    }
}