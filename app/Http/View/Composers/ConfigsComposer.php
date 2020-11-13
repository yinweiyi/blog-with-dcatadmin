<?php


namespace App\Http\View\Composers;

use App\Models\Config;
use Illuminate\View\View;

class ConfigsComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('configs', Config::all()->pluck('value', 'name'));
    }
}
