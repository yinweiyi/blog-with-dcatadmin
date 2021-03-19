<?php


namespace App\Vendors\Redis;


class VisitStatistics extends GetSet
{
    protected $namespace = 'visit_statistics';

    /**
     * @param string $key
     * @return int
     */
    public function visit($key = 'total')
    {
        $key = $this->getKey($key);
        return $this->redis->incr($key);
    }
}
