<?php


namespace App\Vendors\Redis;


class Wechat extends Base
{

    /**
     * @var string 空间
     */
    protected $namespace = 'wechat';

    /**
     * @param $key
     * @param $value
     * @param $expired
     * @return int
     */
    public function set($key, $value, $expired = 3600)
    {
        $key = $this->getKey($key);
        if ($expired) {
            return $this->redis->setex($key, $expired, $value);
        }
        return $this->redis->set($key, $value);
    }

    /**
     * 获取值
     *
     * @param $key
     * @return array
     */
    public function get($key)
    {
        $key = $this->getKey($key);
        return $this->redis->get($key);
    }

}
