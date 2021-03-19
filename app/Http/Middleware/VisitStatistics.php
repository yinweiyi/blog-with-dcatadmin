<?php


namespace App\Http\Middleware;

use Closure;
use App\Vendors\Redis\VisitStatistics as Redis;
use Illuminate\Http\Request;

class VisitStatistics
{
    protected $statistics;

    public function __construct()
    {
        $this->statistics = new Redis();
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure $next
     * @return mixed
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        if ('captcha' !== $request->path()) {
            $this->statistics->visit();
        }

        return $response;
    }

}
