<?php

namespace App\Http\Controllers;

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
        return view('home.index', compact('sentence'));
    }
}
