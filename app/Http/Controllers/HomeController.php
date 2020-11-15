<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Sentence;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $sentence = Sentence::query()->orderByDesc('id')->select(['author', 'content', 'translation', 'created_at'])->first();

        $articles = Article::query()
            ->with(['tags' => function ($query) {
                $query->select(['id', 'name']);
            }])
            ->orderByDesc('is_top')
            ->orderByDesc('id')
            ->paginate(10, ['id', 'title', 'author', 'html', 'views', 'created_at']);
        return view('home.index', compact('sentence', 'articles'));
    }

    public function category($articleId)
    {

    }

    public function tag($articleId)
    {

    }



    public function about()
    {

    }

    public function guestBook()
    {

    }
}
