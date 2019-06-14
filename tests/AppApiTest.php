<?php
namespace MercierCorentin\Nextcloud\Test;

Use MercierCorentin\Nextcloud\App\Status;


class AppApiTest extends TestCase
{
    /**
     * Test list of apps retrieve
     * @return array
     * @group no_modif
     */
    public function testGetListApps(){
        $response = $this->AppApi->getListApps("disabled");
        $this->assertTrue($response['success'], $response["message"]);
        return $response["apps"];
    }

    /**
     * Test App info retrieve
     * @return void
     * @group no_modif
     * @depends testGetListApps
     */
    public function testGetAppInfos($apps){
        $response = $this->AppApi->getAppInfos($apps[0]);
        $this->assertTrue($response["success"]);
    }

    /**
     * Test App info retrieve when app not found
     * @return void
     * @group no_modif
     */
    public function testGetAppInfosFail(){
        $response = $this->AppApi->getAppInfos("impossibleAppNameToGetAnError");
        $this->assertTrue($response["status"]===998);
    }
    
    /**
     * Test app enable
     * @return void
     * @group modif
     * @depends testGetListApps
     */
    public function testEnableApp($apps){
        $response = $this->AppApi->enableApp($apps[0]);
        $this->assertTrue($response["success"]);      
    }

    /**
     * Test app disable
     * @return void
     * @group modif
     * @depends testGetListApps
     */
    public function testDisableApp($apps){
        $response = $this->AppApi->disableApp($apps[0]);
        $this->assertTrue($response["success"]);      
    }
    

}
