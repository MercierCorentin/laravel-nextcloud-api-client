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
    /**
     * method to get nextcloud apps list 
     *
     * @param $appid | string : enabled or disabled
     * @return array [
     *    success: is success request
     *    message: comment message from nextcloud server
     *    response | MercierCorentin\Nextcloud\Response: response object with details of nextcloud answer
     *    ]
     * @throws MercierCorentin\Nextcloud\Exceptions\XMLParseException
     * @throws MercierCorentin\Nextcloud\Exceptions\CurlException
     */
    public function getListApps(string $filter){
        $url = $this->baseUrl . '/' . $this->apiPath .  '/' . $this->appPath . "?filter=".$filter;
        $method = static::METHOD_GET;
        
        $response = $this->request($url, $method);

        $apps = $response->getData("apps");
        $apps = isset($apps['element'])? $apps['element'] : []; 
        $ret = [
            'success'  => $response->getStatus() === Status::GETLIST_APP_OK,
            'message'  => $response->getMessage(),
            'apps'     => $apps,
            'response' => $response,
        ];

        return $ret;
    }  
    /**
     * method to get nextcloud app infos 
     *
     * @param $appid | string : app name 
     * @return array [
     *    success: is success request
     *    message: comment message from nextcloud server
     *    response | MercierCorentin\Nextcloud\Response: response object with details of nextcloud answer
     *    ]
     * @throws MercierCorentin\Nextcloud\Exceptions\XMLParseException
     * @throws MercierCorentin\Nextcloud\Exceptions\CurlException
     */
    public function getAppInfos(string $appid){
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

    /**
     * method to enable nextcloud app 
     *
     * @param $appid | string : app name 
     * @return array [
     *    success: is success request
     *    message: comment message from nextcloud server
     *    response | MercierCorentin\Nextcloud\Response: response object with details of nextcloud answer
     *    ]
     * @throws MercierCorentin\Nextcloud\Exceptions\XMLParseException
     * @throws MercierCorentin\Nextcloud\Exceptions\CurlException
     */
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

    /**
     * method to disable nextcloud app 
     *
     * @param $appid | string : app name 
     * @return array [
     *    success: is success request
     *    message: comment message from nextcloud server
     *    response | MercierCorentin\Nextcloud\Response: response object with details of nextcloud answer
     *    ]
     * @throws MercierCorentin\Nextcloud\Exceptions\XMLParseException
     * @throws MercierCorentin\Nextcloud\Exceptions\CurlException
     */
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