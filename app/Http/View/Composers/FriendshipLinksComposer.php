<?php


namespace App\Http\View\Composers;

use App\Models\FriendshipLink;
use Illuminate\View\View;

class FriendshipLinksComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('links', FriendshipLink::query()->where('is_enable', 1)->orderByDesc('id')->select(['title', 'link'])->get());
    }
}
