<?php
namespace MercierCorentin\Nextcloud\Group;

use MercierCorentin\Nextcloud\Exceptions\CurlException;
use MercierCorentin\Nextcloud\Api;
use MercierCorentin\Nextcloud\Group\Status;



/**
* class MercierCorentin\Nextcloud\Group\GroupApi
*/
class GroupApi extends Api
{
    /**
     * method to search/get nextcloud group 
     *
     * @param $search | string : query 
     * @param $limit  | int    : number of max results
     * @param $offset | int    :  
     * @return array [
     *    success: is success request
     *    message: comment message from nextcloud server
     *    response | MercierCorentin\Nextcloud\Response: response object with details of nextcloud answer
     *    ]
     * @throws MercierCorentin\Nextcloud\Exceptions\XMLParseException
     * @throws MercierCorentin\Nextcloud\Exceptions\CurlException
     */
    public function searchGroups(string $search, int $limit = null, int $offset = 0){
        $url = $this->baseUrl . '/' . $this->apiPath .  '/' . $this->groupPath . "?search=" . $search . "&offset=".$offset;
        if(null!== $limit){
            $url .= "&limit=" . $limit; 
        }
        $method = static::METHOD_GET;
        
        $response = $this->request($url, $method);

        $groups = $response->getData("groups");
        $groups = isset($groups['element'])? $groups['element'] : []; 

        $ret = [
            'success' => $response->getStatus() === Status::SEARCHGROUP_OK,
            'message' => $response->getMessage(),
            'groups'  => $groups,
            'response' => $response,
        ];

        return $ret;
    }    
    /**
     * method to create nextcloud group 
     *
     * @param $groupid | string
     * @return array [
     *    success: is success request
     *    message: comment message from nextcloud server
     *    response | MercierCorentin\Nextcloud\Response: response object with details of nextcloud answer
     *    ]
     * @throws MercierCorentin\Nextcloud\Exceptions\XMLParseException
     * @throws MercierCorentin\Nextcloud\Exceptions\CurlException
     */
    public function createGroup(string $groupid){
        $url = $this->baseUrl . '/' . $this->apiPath .  '/' . $this->groupPath;
        $method = static::METHOD_POST;
        
        $params = $this->serializeParams([
            'groupid' => $groupid
        ]);

        $response = $this->request($url, $method, $params);

        $ret = [
            'success' => $response->getStatus() === Status::CREATEGROUP_OK,
            'message' => $response->getMessage(),
            'response' => $response,
        ];

        return $ret;
    }

    /**
     * method to get nextcloud group users
     *
     * @param $groupid | string
     * @return array [
     *    success: is success request
     *    message: comment message from nextcloud server
     *    users: array wich contains all group users
     *    response | MercierCorentin\Nextcloud\Response: response object with details of nextcloud answer
     *    ]
     * @throws MercierCorentin\Nextcloud\Exceptions\XMLParseException
     * @throws MercierCorentin\Nextcloud\Exceptions\CurlException
     */
    public function getGroupUsers(string $groupid){
        $url = $this->baseUrl . '/' . $this->apiPath .  '/' . $this->groupPath . "/" . $groupid;
        $method = static::METHOD_GET;
        

        $response = $this->request($url, $method);
        $users = $response->getData('users');
        $users = isset($users['element'])? $users['element'] : []; 

        $ret = [
            'success' => $response->getStatus() === Status::GETGROUP_USERS_OK,
            'message' => $response->getMessage(),
            'users'   => $users,
            'response' => $response,
        ];

        return $ret;
    }

    /**
     * method to get nextcloud group subadmins
     *
     * @param $groupid | string
     * @return array [
     *    success: is success request
     *    message: comment message from nextcloud server
     *    subadmins: array wich contains all group subadmins
     *    response | MercierCorentin\Nextcloud\Response: response object with details of nextcloud answer
     *    ]
     * @throws MercierCorentin\Nextcloud\Exceptions\XMLParseException
     * @throws MercierCorentin\Nextcloud\Exceptions\CurlException
     */
    public function getGroupSubadmins(string $groupid){
        $url = $this->baseUrl . '/' . $this->apiPath .  '/' . $this->groupPath . "/" . $groupid . "/subadmins";
        $method = static::METHOD_GET;
        

        $response = $this->request($url, $method);
        $subadmins = $response->getData();
        $subadmins = isset($subadmins['element'])? $subadmins['element'] : []; 
        
        $ret = [
            'success' => $response->getStatus() === Status::SUBADMINSGROUP_OK,
            'message' => $response->getMessage(),
            'subadmins'   => $subadmins,
            'response' => $response,
        ];

        return $ret;
    }

    /**
     * method to delete nextcloud group
     *
     * @param $groupid | string
     * @return array [
     *    success: is success request
     *    message: comment message from nextcloud server
     *    response | MercierCorentin\Nextcloud\Response: response object with details of nextcloud answer
     *    ]
     * @throws MercierCorentin\Nextcloud\Exceptions\XMLParseException
     * @throws MercierCorentin\Nextcloud\Exceptions\CurlException
     */
    public function deleteGroup(string $groupid){
        $url = $this->baseUrl . '/' . $this->apiPath .  '/' . $this->groupPath . "/" . $groupid;
        $method = static::METHOD_DELETE;
    
        $response = $this->request($url, $method);
        $ret = [
            'success' => $response->getStatus() === Status::DELETEGROUP_OK,
            'message' => $response->getMessage(),
            'response' => $response,
        ];

        return $ret;
    }
}

