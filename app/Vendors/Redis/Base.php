<?php


namespace App\Vendors\Redis;


use Illuminate\Cache\Repository;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redis;

abstract class Base
{

    /**
     * @var \Predis\Client|\Illuminate\Contracts\Cache\Store
     */
    protected $redis;

    /**
     * @var string 空间
     */
    protected $namespace = 'base';

    /**
     * @var string 前缀
     */
    protected $prefix = '';

    /**
     * @var string 数据库
     */
    protected $db = 'default';


    public function __construct($store = null)
    {
        $this->redis = $this->getRedis($store);
    }

    /**
     * 获取key
     *
     * @param $name
     * @return string
     */
    protected function getKey($name = null)
    {
        return $this->prefix . ':' . $this->namespace . ($name ? ':' . $name : '');
    }

    /**
     * @param null $store
     * @return \Illuminate\Redis\Connections\Connection|null
     */
    protected function getRedis($store = null)
    {
        return $store ? $store : Redis::connection($this->db);
    }

    /**
     * 清除缓存
     *
     * @return bool|int
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function clear()
    {
        $key = $this->getKey();
        $keys = $this->redis->keys($key . '*');
        $prefix = Config::get('database.redis.options.prefix');

        $keys = array_map(function ($key) use ($prefix) {
            return str_replace($prefix, '', $key);
        }, $keys);

        return $this->redis instanceof Repository ? $this->redis->deleteMultiple($keys) : $this->redis->del($keys);
    }
}
