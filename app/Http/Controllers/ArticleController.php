<?php

namespace App\Http\Controllers;

use App\Models\Article;

class ArticleController extends Controller
{
    /**
     * 文章详情
     *
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $article = Article::query()->select(['id', 'title', 'author', 'html', 'views', 'category_id'])->with(['category' => function ($query) {
            $query->select(['id', 'name']);
        }])->withCount('comments')->find($id);

        $article->increment('views');

        $lastArticle = Article::query()->select(['id', 'title'])->where('id', '<', $id)->orderByDesc('id')->first();
        $nextArticle = Article::query()->select(['id', 'title'])->where('id', '>', $id)->orderBy('id')->first();

        return view('article.detail', compact('article', 'lastArticle', 'nextArticle'));
    }
}
