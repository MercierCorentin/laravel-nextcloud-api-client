<?php
namespace MercierCorentin\Nextcloud\Test;

use MercierCorentin\Nextcloud\Group\GroupApi;

class MyPackageFunctionTest extends TestCase
{
    /**
     * Check that the multiply method returns correct result
     * @return void
     * @dataProvider createGroupProvider
     */
    public function testCreateGroup($groupId){
        $response = GroupApi::createGroup($groupId);
    }

    public function testDeleteGroup(){
    }

    public function testSearchGroups(){
    }

    public function testGetGroupUsers(){

    }

    public function testGetGroupSubadmins(){

    }
    // Providers
    public function createGroupProvider(){
        $groupIds = [];
        for ($i = 1; $i <= 5; $i++ ){ 
            array_push($groupIds, "Test".$i );
        }
        return $groupIds;
    }
}