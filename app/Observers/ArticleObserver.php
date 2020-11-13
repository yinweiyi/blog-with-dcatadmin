<?php

namespace App\Observers;

use App\Models\Article;
use Illuminate\Mail\Markdown;

class ArticleObserver
{

    /**
     * parse markdown to html
     *
     * @param Article $article
     */
    public function saving(Article $article)
    {
        $article->setAttribute('html', Markdown::parse($article->getAttribute('markdown')));
    }
}
