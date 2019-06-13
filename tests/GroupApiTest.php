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
        $GroupApi = new GroupApi;
        $response = $GroupApi->createGroup($groupId);
        $this->assertEquals(Status::CREATEGROUP_OK, $response["status"]);
    }

    /**
     * @return void
     * @group creation
     * @dataProvider groupProvider
     */
    public function testCreateExistGroup($groupId){
        $GroupApi = new GroupApi;
        $response = $GroupApi->createGroup($groupId);
        $this->assertEquals(Status::CREATEGROUP_EXIST, $response["status"]);
    }

    /**
     * @return void
     * @group no_modif
     */
    public function testSearchGroupsAll(){
        $GroupApi = new GroupApi;
        $response = $GroupApi->searchGroups($this->groupIdRoot);
        
        // Formatting output of groupProvider
        $groupsProvided = [];
        foreach($this->groupProvider() as $element){
            array_push($groupsProvided, $element[0]);
        }

        // Assertions
        $this->assertTrue($response["success"]);
        $this->assertSame(
            $groupsProvided,
            $response["groups"]
        );
    }

    /**
     * @return void
     * @dataProvider groupProvider
     * @group delete
     */
    public function testDeleteGroup($groupId){
        $GroupApi = new GroupApi;
        $response = $GroupApi->deleteGroup($groupId);
        $this->assertTrue($response["success"]);
    }

    public function groupProvider(){
        $groupIds = [];
        for ($i = 1; $i <= $this->groupNumber; $i++ ){ 
            array_push($groupIds, [$this->groupIdRoot.$i] );
        }
        return $groupIds;
    }
}