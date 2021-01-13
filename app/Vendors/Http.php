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
     *  get请求
     *
     * @param $url
     * @param array $params
     * @param array $header
     * @param int $timeout
     * @param bool $decode
     * @return array|string|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function get($url, $params = [], $header = [], $timeout = 10, $decode = true)
    {
        $client = self::getClient();
        $response = $client->get($url, ['query' => $params, 'connect_timeout' => $timeout, 'headers' => $header]);
        $content = $response->getBody()->getContents();
        return $decode ? json_decode($content, true) : $content;
    }

    /**
     * @param $url
     * @param array $params
     * @param array $header
     * @param int $timeout
     * @param bool $decode
     * @return mixed|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function postBody($url, $params = [], $header = [], $timeout = 5, $decode = true)
    {
        $params = is_array($params) ? \json_encode($params, JSON_UNESCAPED_UNICODE) : $params;
        $client = self::getClient();
        $response = $client->post($url, ['body' => $params, 'connect_timeout' => $timeout, 'headers' => $header]);
        $content = $response->getBody()->getContents();
        return $decode ? json_decode($content, true) : $content;
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

}

