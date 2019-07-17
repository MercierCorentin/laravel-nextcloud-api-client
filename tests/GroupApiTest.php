<?php
namespace MercierCorentin\Nextcloud\Test;

use MercierCorentin\Nextcloud\Group\Status;

class GroupApiTest extends TestCase
{

    private $groupIdRoot = "Test";
    
    private $groupNumber = 5;

    /**
     * Tests group creation
     * @return void
     * @group creation
     * @dataProvider groupProvider
     */
    public function testCreateGroup($groupId){
        $response = $this->GroupApi->createGroup($groupId);
        $this->assertEquals(
            Status::CREATEGROUP_OK,
            $response["status"],
            $response["message"]
        );
    }

    /**
     * Tests group creation with groupId already used
     * @return void
     * @group creation
     * @dataProvider groupProvider
     */
    public function testCreateExistGroup($groupId){
        $response = $this->GroupApi->createGroup($groupId);
        $this->assertEquals(
            Status::CREATEGROUP_EXIST,
            $response["status"],
            $response["message"]
        );
    }

    /**
     * Tests all groups retrieve
     * @return array $groups 
     * @group no_modif
     */
    public function testSearchGroupsAll(){
        $response = $this->GroupApi->searchGroups($this->groupIdRoot);
        
        // Formatting output of groupProvider
        $groupsProvided = [];
        foreach($this->groupProvider() as $element){
            array_push($groupsProvided, $element[0]);
        }

        // Assertions
        $this->assertTrue($response["success"], $response["message"]);
        $this->assertSame(
            $groupsProvided,
            $response["groups"],
            $response["message"]
        );
        return $response['groups'];
    }

    /**
     * Test Group users retrieve
     * @return void
     * @dataProvider groupProvider
     * @group no_modif
     */
    public function testGetGroupUsers($groupId){
        $response = $this->GroupApi->getGroupUsers($groupId);
        $this->assertTrue($response["success"], $response["message"]);
    }

    /**
     * Test Group Subadmins retrieve
     * @return void
     * @dataProvider groupProvider
     * @group no_modif
     */
    public function testGetGroupSubadmins($groupId){
        $response = $this->GroupApi->getGroupUsers($groupId);
        $this->assertTrue($response["success"], $response["message"]);
    }

    /**
     * @return void
     * @dataProvider groupProvider
     * @group delete
     */
    public function testDeleteGroup($groupId){
        $response = $this->GroupApi->deleteGroup($groupId);
        $this->assertTrue($response["success"], $response["message"]);
    }

    public function groupProvider(){
        $groupIds = [];
        for ($i = 1; $i <= $this->groupNumber; $i++ ){ 
            array_push($groupIds, [$this->groupIdRoot.$i] );
        }
        return $groupIds;
    }
}