<?php


namespace App\Vendors;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class Http
{
    /**
     * @var Client
     */
    protected static $client = null;

    /**
     * get请求
     *
     * @param $url
     * @param array $params
     * @param array $header
     * @param int $timeout
     * @param false $log
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function get($url, $params = [], $header = [], $timeout = 10, $log = false)
    {
        $client = self::getClient();
        $response = $client->get($url, ['query' => $params, 'connect_timeout' => $timeout, 'headers' => $header]);
        $content = $response->getBody()->getContents();
        $log && self::log($url, 'get', $header, $params, $content);
        return $content;
    }

    /**
     * 获取client
     *
     * @return Client|null
     */
    public static function getClient()
    {
        if ($client = self::$client) {
            return $client;
        }
        self::$client = new Client();

        return self::$client;
    }

    /**
     * 第三方请求日志
     *
     * @param $url
     * @param $method
     * @param $header
     * @param $params
     * @param $result
     */
    private static function log($url, $method, $header, $params, $result)
    {
        Log::channel('http_client')->info(\json_encode(compact('url', 'method', 'header', 'params', 'result')));
    }
}

