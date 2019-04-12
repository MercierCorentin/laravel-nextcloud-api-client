<?php
namespace MercierCorentin\Nextcloud;

use MercierCorentin\Nextcloud\Exceptions\CurlException;


/**
* class MasterZero\Nextcloud\Api
*/
class Api
{

    /**
     * login for http-auth in nextcloud api
     */
    protected $login;

    /**
     * password for http-auth in nextcloud api
     */
    protected $password;

    /**
     * url for nextcloud server. It must includes protocol. The end of url must no contains '/' character
     * examples:
     * http://localhost
     * https://production-site.com
     * http://develop.localhost:3500
     */
    protected $baseUrl;

    /**
     * path to api endpoint
     */
    protected $apiPath = 'ocs/v1.php';

    /**
     * verify ssl sertificates on nextcloud server.
     * must be 'true' in production
     */
    protected $sslVerify = true;

    /**
     * path for user actions
     */
    protected $userPath = 'cloud/users';

    /**
     * path for user actions
     */
    protected $groupPath = 'cloud/groups';

    /**
     * path suffix for enable
     */
    protected $enablePath = 'enable';


    /**
     * path suffix for disable
     */
    protected $disablePath = 'disable';


    /**
     * http methods
     */
    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';
    const METHOD_PUT = 'PUT';
    const METHOD_DELETE = 'DELETE';


    /**
     * @param $params | array
     * contain custom parameters to create Api instance.
     * all  defined in $params parameters will be overwrited by them.
     */
    public function __construct(array $params = [])
    {

        $this->login = $params['login'] ?? config("nextcloud.login");
        $this->password = $params['password'] ?? config("nextcloud.password");
        $this->baseUrl = $params['baseUrl'] ?? config("nextcloud.baseUrl");


        $initialParam = [
            'apiPath',
            'sslVerify',

            'userPath',
            'enablePath',
            'disablePath',
        ];

        foreach ($initialParam as $param) {

            if (isset($params[$param])) {
                $this->$param = $params[$param];
            }

        }

    }

    /**
     * get default required headers
     *
     * @return array
     */
    protected function defaultHeaders(): array
    {
        return [
            'Content-Type: application/x-www-form-urlencoded',
            'OCS-APIRequest: true'
        ];
    }

     /**
     * serialize array [key1 => value1, key2 => value2] to string key1=value1&key2=value2
     *
     * @return string
     */
    protected function serializeParams(array $params): string
    {

        if (!count($params)) {
            return '';
        }

        $expressions = [];

        foreach ($params as $key => $value) {
            if(is_array($value)){
                foreach ($value as $item) {
                    $expressions[] = urlencode($key . "[]" ) . '=' . urlencode($item); 
                }
            }else {
                $expressions[] = urlencode($key) . '=' . urlencode($value);
            }
        }

        return implode('&', $expressions);
    }


    /**
     * do request
     *
     * @param $url | string
     * @param $method | string
     * @param $headers | array of strings
     * @return MasterZero\Nextcloud\Response
     * @throws MasterZero\Nextcloud\Exceptions\XMLParseException
     * @throws MasterZero\Nextcloud\Exceptions\CurlException
     */
    protected function request(string $url, string $method = 'GET', $data = '', array $headers = []) : Response
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if($method === static::METHOD_POST) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        } elseif ($method === static::METHOD_PUT || $method === static::METHOD_DELETE) {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }

        $userowd = $this->login . ':' . $this->password;
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, $userowd);


        $headers = array_merge($this->defaultHeaders(), $headers);

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $this->sslVerify);// this should be set to true in production

        $responseData = curl_exec($ch);

        if(curl_errno($ch)) {
            throw new CurlException('[Nextcloud] ' . curl_error($ch), 1);
        }

        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        return new Response($responseData, $httpcode);
    }
}

