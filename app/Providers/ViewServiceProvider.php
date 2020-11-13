<?php

namespace App\Providers;

use App\Http\View\Composers\ConfigsComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{

    protected $composers = [
        ConfigsComposer::class => ['layouts.footer', 'master'],
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        foreach ($this->composers as $class => $views) {
            View::composer($views, $class);
        }
    }
}
