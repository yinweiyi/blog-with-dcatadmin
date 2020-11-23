<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Services\CommentService;

class ArticleController extends Controller
{
    /**
     * 文章详情
     *
     * @param CommentService $commentService
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(CommentService $commentService, $id)
    {
        $article = Article::query()->select(['id', 'title', 'author', 'keywords', 'html', 'views', 'category_id'])->with(['category' => function ($query) {
            $query->select(['id', 'name']);
        }])->withCount(['comments' => function($query) {
            $query->where('is_audited', 1);
        }])->find($id);

        $article->increment('views');

        $last = Article::query()->select(['id', 'title'])->where('id', '<', $id)->orderByDesc('id')->first();
        $next = Article::query()->select(['id', 'title'])->where('id', '>', $id)->orderBy('id')->first();

        $comments = $commentService->treeFromArticle($article);

        return view('article.show', compact('article', 'last', 'next', 'comments'));
    }
}
