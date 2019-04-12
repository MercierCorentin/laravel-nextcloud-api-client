<?php
namespace MercierCorentin\Nextcloud\App;

use MercierCorentin\Nextcloud\Exceptions\CurlException;
use MercierCorentin\Nextcloud\Api;
use MercierCorentin\Nextcloud\App\Status;



/**
* class MercierCorentin\Nextcloud\Group\GroupApi
*/
class AppApi extends Api
{
    public function getListApps(string $filter){
        $url = $this->baseUrl . '/' . $this->apiPath .  '/' . $this->appPath . "?filter=".$filter;
        $method = static::METHOD_GET;
        
        $response = $this->request($url, $method);

        $apps = $response->getData("apps");
        $ret = [
            'success' => $response->getStatus() === Status::GETLIST_APP_OK,
            'message' => $response->getMessage(),
            'apps'  => $apps['element'],
            'response' => $response,
        ];

        return $ret;
    }  
    
    public function getAppInfo(string $appid){
        $url = $this->baseUrl . '/' . $this->apiPath .  '/' . $this->appPath . "/". $appid;
        $method = static::METHOD_GET;
        
        $response = $this->request($url, $method);

        $infos = $response->getData();
        $ret = [
            'success'  => $response->getStatus() === Status::GET_INFO_APP_OK,
            'message'  => $response->getMessage(),
            'infos'    => $infos,
            'response' => $response,
        ];

        return $ret;
    }

    public function enableApp(string $appid){
        $url = $this->baseUrl . '/' . $this->apiPath .  '/' . $this->appPath . "/". $appid;
        $method = static::METHOD_POST;
        $response = $this->request($url, $method);

        $ret = [
            'success'  => $response->getStatus() === Status::ENABLE_APP_OK,
            'message'  => $response->getMessage(),
            'response' => $response,
        ];

        return $ret;  
    }
    public function disableApp(string $appid){
        $url = $this->baseUrl . '/' . $this->apiPath .  '/' . $this->appPath . "/". $appid;
        $method = static::METHOD_DELETE;
        $response = $this->request($url, $method);

        $ret = [
            'success'  => $response->getStatus() === Status::DISABLE_APP_OK,
            'message'  => $response->getMessage(),
            'response' => $response,
        ];

        return $ret;  
    }
}