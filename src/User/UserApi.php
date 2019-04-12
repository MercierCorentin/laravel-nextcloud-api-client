<?php
namespace MercierCorentin\Nextcloud\User;

use MercierCorentin\Nextcloud\Exceptions\CurlException;
use MercierCorentin\Nextcloud\Api;
use MercierCorentin\Nextcloud\Status;


/**
* class MercierCorentin\Nextcloud\User\UserApi
*/
class UserApi extends Api
{
    /**
     * method to get nextcloud user list
     *
     * @param $search | string: string to search users by userid
     * @param $limit | int
     * @param $offset | int
     * @return array [
     *    success: is success request
     *    message: comment message from nextcloud server
     *    users: array of userid's
     *    response | MercierCorentin\Nextcloud\Response: response object with details of nextcloud answer
     *    ]
     * @throws MercierCorentin\Nextcloud\Exceptions\XMLParseException
     * @throws MercierCorentin\Nextcloud\Exceptions\CurlException
     */
    public function getUserList(string $search = '', int $limit = 0, int $offset = 0) : array
    {

        $url = $this->baseUrl . '/' . $this->apiPath .  '/' . $this->userPath;
        $method = static::METHOD_GET;

        $params = [];

        if (strlen($search)) {
            $params['search'] = $search;
        }

        if ($limit) {
            $params['limit'] = $limit;
        }

        if ($offset) {
            $params['offset'] = $offset;
        }


        if (!empty($params)) {
            $url .= '?' . $this->serializeParams($params);
        }

        $response = $this->request($url, $method);

        $userData = $response->getData('users');
        $userData = isset($userData['element'])? $userData['element'] : []; 


        $ret = [
            'success' => $response->getStatus() === Status::USERLIST_OK,
            'message' => $response->getMessage(),
            'users' => $userData['element'],
            'response' => $response,
        ];

        return $ret;
    }


    /**
     * method to create nextcloud user
     *
     * @param $userid | string: username for create. must be unique.
     * @param $password | string
     * @return array [
     *    success: is success request
     *    message: comment message from nextcloud server
     *    response | MercierCorentin\Nextcloud\Response: response object with details of nextcloud answer
     *    ]
     * @throws MercierCorentin\Nextcloud\Exceptions\XMLParseException
     * @throws MercierCorentin\Nextcloud\Exceptions\CurlException
     */
    public function createUser(
        string $userid,     
        string $password = '',
        string $displayName = '',
        string $email = '',
        array $groups = [],
        array $subadmin = [],
        string $quota = '',
        string $language = ''
    ) 
    {

        $url = $this->baseUrl . '/' . $this->apiPath .  '/' . $this->userPath;
        $method = static::METHOD_POST;

        $params = $this->serializeParams([
            'userid'        => $userid,
            'password'      => $password,
            'displayName'   => $displayName,
            'email'         => $email,
            'groups'        => $groups,
            'subadmin'      => $subadmin,
            'quota'         => $quota,
            'language'      => $language 
        ]);

        $response = $this->request($url, $method, $params);


        $ret = [
            'success' => $response->getStatus() === Status::CREATEUSER_OK,
            'message' => $response->getMessage(),
            'response' => $response,
        ];


        return $ret;
    }


    /**
     * method to edit nextcloud user parameters
     *
     * @param $userid | string
     * @param $key | string: parameter to edit (email | quota | display | password)
     * @param $value | string
     * @return array [
     *    success: is success request
     *    message: comment message from nextcloud server
     *    response | MercierCorentin\Nextcloud\Response: response object with details of nextcloud answer
     *    ]
     * @throws MercierCorentin\Nextcloud\Exceptions\XMLParseException
     * @throws MercierCorentin\Nextcloud\Exceptions\CurlException
     */
    public function editUser(string $userid, string $key, string $value) : array
    {

        $url = $this->baseUrl . '/' . $this->apiPath .  '/' . $this->userPath . '/' . $userid;
        $method = static::METHOD_PUT;

        $params = $this->serializeParams([
            'key' => $key,
            'value' => $value,
        ]);

        $response = $this->request($url, $method, $params);


        $ret = [
            'success' => $response->getStatus() === Status::EDITUSER_OK,
            'message' => $response->getMessage(),
            'response' => $response,
        ];

        return $ret;
    }

    /**
     * method to resend nextcloud welcome email
     *
     * @param $userid | string
     * @return array [
     *    success: is success request
     *    message: comment message from nextcloud server
     *    response | MercierCorentin\Nextcloud\Response: response object with details of nextcloud answer
     *    ]
     * @throws MercierCorentin\Nextcloud\Exceptions\XMLParseException
     * @throws MercierCorentin\Nextcloud\Exceptions\CurlException
     */
    public function Welcome(string $userid) : array
    {

        $url = $this->baseUrl . '/' . $this->apiPath .  '/' . $this->userPath . '/' . $userid . "/welcome";
        $method = static::METHOD_POST;

        $response = $this->request($url, $method);


        $ret = [
            'success' => $response->getStatus() === Status::WELCOME_OK,
            'message' => $response->getMessage(),
            'response' => $response,
        ];

        return $ret;
    }


    /**
     * method to disable nextcloud user
     *
     * @param $userid | string
     * @return array [
     *    success: is success request
     *    message: comment message from nextcloud server
     *    response | MercierCorentin\Nextcloud\Response: response object with details of nextcloud answer
     *    ]
     * @throws MercierCorentin\Nextcloud\Exceptions\XMLParseException
     * @throws MercierCorentin\Nextcloud\Exceptions\CurlException
     */
    public function disableUser(string $userid) : array
    {

        $url = $this->baseUrl . '/' . $this->apiPath .  '/' . $this->userPath . '/' . $userid . '/' . $this->disablePath;
        $method = static::METHOD_PUT;

        $response = $this->request($url, $method);

        $ret = [
            'success' => $response->getStatus() === Status::DISABLEUSER_OK,
            'message' => $response->getMessage(),
            'response' => $response,
        ];

        return $ret;
    }



    /**
     * method to enable nextcloud user
     *
     * @param $userid | string
     * @return array [
     *    success: is success request
     *    message: comment message from nextcloud server
     *    response | MercierCorentin\Nextcloud\Response: response object with details of nextcloud answer
     *    ]
     * @throws MercierCorentin\Nextcloud\Exceptions\XMLParseException
     * @throws MercierCorentin\Nextcloud\Exceptions\CurlException
     */
    public function enableUser(string $userid) : array
    {
        $url = $this->baseUrl . '/' . $this->apiPath .  '/' . $this->userPath . '/' . $userid . '/' . $this->enablePath;
        $method = static::METHOD_PUT;

        $response = $this->request($url, $method);

        $ret = [
            'success' => $response->getStatus() === Status::ENABLEUSER_OK,
            'message' => $response->getMessage(),
            'response' => $response,
        ];

        return $ret;
    }



    /**
     * method to delete nextcloud user
     *
     * @param $userid | string
     * @return array [
     *    success: is success request
     *    message: comment message from nextcloud server
     *    response | MercierCorentin\Nextcloud\Response: response object with details of nextcloud answer
     *    ]
     * @throws MercierCorentin\Nextcloud\Exceptions\XMLParseException
     * @throws MercierCorentin\Nextcloud\Exceptions\CurlException
     */
    public function deleteUser(string $userid) : array
    {
        $url = $this->baseUrl . '/' . $this->apiPath .  '/' . $this->userPath . '/' . $userid;
        $method = static::METHOD_DELETE;

        $response = $this->request($url, $method);

        $ret = [
            'success' => $response->getStatus() === Status::DELETEUSER_OK,
            'message' => $response->getMessage(),
            'response' => $response,
        ];

        return $ret;
    }


}

