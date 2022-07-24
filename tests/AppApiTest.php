<?php
namespace MercierCorentin\Nextcloud\Test;

Use MercierCorentin\Nextcloud\App\Status;


class AppApiTest extends TestCase
{
    /**
     * Test list of apps retrieve
     * @return array
     * @group modif
     */
    public function testGetListApps(){
        $response = $this->AppApi->getListApps("enabled");
        $this->assertTrue($response["success"], $response["message"]);
        return $response["apps"];
    }

    /**
     * Test App info retrieve
     * @return void
     * @group modif
     * @depends testGetListApps
     */
    public function testGetAppInfos($apps){
        $this->markTestSkipped("There is a bug in nextcloud server, the app info is not retrieve");
        // $response = $this->AppApi->getAppInfos($apps[0]);
        // $this->assertTrue($response["success"], $response["message"]);
    }

    /**
     * Test App info retrieve when app not found
     * @return void
     * @group no_modif
     */
    public function testGetAppInfosFail(){
        $response = $this->AppApi->getAppInfos("impossibleAppNameToGetAnError");
        $this->assertTrue($response["status"] === 998, $response["message"]);
    }
    
    /**
     * Test app enable
     * @return void
     * @group modif
     * @depends testGetListApps
     * @depends testDisableApp
     */
    public function testEnableApp($apps){
        $response = $this->AppApi->enableApp("encryption");
        $this->assertTrue($response["success"], $response["message"]);      
    }

    /**
     * Test app disable
     * @return void
     * @group modif
     * @depends testGetListApps
     */
    public function testDisableApp($apps){
        $response = $this->AppApi->disableApp("encryption");
        $this->assertTrue($response["success"], $response["message"]);      
    }
    

}
