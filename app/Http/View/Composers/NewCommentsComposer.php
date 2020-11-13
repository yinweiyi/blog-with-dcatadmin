<?php


namespace App\Http\View\Composers;

use Illuminate\View\View;

class NewCommentsComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('newComments', []);
    }
}
