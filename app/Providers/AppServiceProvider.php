<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Carbon::setLocale('zh');
        Paginator::useBootstrap();

        // 只在本地开发环境启用 SQL 日志
        $request = $this->app['request'];
        // 只在本地开发环境启用 SQL 日志
        if (!app()->environment('product')) {
            \DB::listen(function ($query) use ($request) {
                \Log::info(Str::replaceArray('?', $query->bindings, $query->sql) . ' Times: ' . $query->time . 'ms' . ' Path: ' . $request->path());
            });
        }
    }
}
