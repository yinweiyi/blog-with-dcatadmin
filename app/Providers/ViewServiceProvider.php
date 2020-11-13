<?php

namespace App\Providers;

use App\Http\View\Composers\ConfigsComposer;
use App\Http\View\Composers\TagsComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{

    protected $composers = [
        ConfigsComposer::class => ['layouts.footer', 'layouts.nav', 'master'],
        TagsComposer::class    => ['layouts.footer', 'layouts.tags'],
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
