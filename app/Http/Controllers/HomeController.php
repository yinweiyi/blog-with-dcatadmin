<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Article;
use App\Models\Guestbook;
use App\Models\Tag;
use App\Services\CommentService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {

        $articles = Article::query()
            ->with(['tags' => function ($query) {
                $query->select(['id', 'name']);
            }])
            ->orderByDesc('is_top')
            ->orderByDesc('id')
            ->paginate(10, ['id', 'title', 'author', 'html', 'views', 'created_at']);
        return view('home.index', compact('articles'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function category($id)
    {
        $articles = Article::query()
            ->with(['tags' => function ($query) {
                $query->select(['id', 'name']);
            }])
            ->where('category_id', $id)
            ->orderByDesc('is_top')
            ->orderByDesc('id')
            ->paginate(10, ['id', 'title', 'author', 'html', 'views', 'created_at']);
        return view('home.index', compact('articles'));
    }

    public function tag(Tag $tag)
    {
        $articles = $tag->articles()
            ->with(['tags' => function ($query) {
                $query->select(['id', 'name']);
            }])
            ->orderByDesc('is_top')
            ->orderByDesc('id')
            ->paginate(10, ['id', 'title', 'author', 'html', 'views', 'created_at']);
        return view('home.index', compact('articles'));
    }


    /**
     * 关于
     * @param CommentService $commentService
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function about(CommentService $commentService)
    {
        $abouts = About::query()->where('is_enable', 1)->withCount(['comments' => function ($query) {
            $query->where('is_audited', 1);
        }])->orderBy('order')->get();

        $comments = null;
        if ($abouts->count()) {
            $comments = $commentService->treeFromArticle($abouts->first());
        }


        return view('home.about', compact('abouts', 'comments'));
    }

    /**
     * @param CommentService $commentService
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function guestbook(CommentService $commentService)
    {
        $guestbook = Guestbook::query()->withCount(['comments' => function ($query) {
            $query->where('is_audited', 1);
        }])->first();

        $comments = null;
        if (!is_null($guestbook)) {
            $comments = $commentService->treeFromArticle($guestbook);
        }
        return view('home.guestbook', compact('guestbook', 'comments'));
    }
}
