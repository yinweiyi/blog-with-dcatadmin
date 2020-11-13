<?php


namespace App\Http\View\Composers;

use App\Models\Article;
use Illuminate\View\View;

class HotsComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('hots', Article::query()->orderByDesc('views')->select(['title', 'author', 'html', 'description', 'keywords', 'views', 'created_at'])->get());
    }
}
