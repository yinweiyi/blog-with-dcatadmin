@extends('master')

@section('container')
    <div class="row">
        <div class="col-md-8">
            <div id="article" class="well"> 当前位置：
                <a href="{{ route('home.index') }}" title="{{ $config['title'] ?? '' }}">博客首页</a>&gt;&gt;
                <a href="{{ route('home.index_category', ['id' => $article->category_id]) }}">{{ $article->category->name }}</a>
                &gt;&gt; 阅读正文
                <h2 class="blog-post-title">
                    {{ $article->title }}
                </h2>
                <p class="info"><span class="meat_span">作者: {{ $config['author'] ?? '' }}</span>
                    <span class="meat_span">分类:
                        <a href="{{ route('home.index_category', ['id' => $article->category_id]) }}"
                           rel="category tag">{{ $article->category->name }}</a>
                    </span> <span class="meat_span">发布于: {{ $article->created_at }}</span>
                    <span class="meat_span">浏览：{{ number_format($article->views) }}</span>
                    <span class="meat_span">
                        <a href="{{ request()->fullUrl() . '#comments' }}">评论({{ $article->comments_count }})</a></span>
                </p>
                <hr>
                <div class="text">
                    {!! $article->html !!}
                </div>
                <div class="alert alert-success"> &nbsp; &nbsp; &nbsp; &nbsp;
                    <div class="post-copyright">
                        <p>本文采用
                            <a rel="license" href="http://creativecommons.org/licenses/by-nc/3.0/cn/">
                                知识共享署名-非商业性使用 3.0 中国大陆许可协议
                            </a>进行许可，转载时请注明出处及相应链接。
                        </p>
                        <p>本文永久链接: {{ request()->fullUrl() }}</p></div>
                </div>
            </div>
            @include('layouts.comment', ['id' => $article->id, 'type' => 'article'])
        </div><!-- /.blog-main -->
        <div class="col-md-4">
            @include('layouts.tags')
            @include('layouts.hots')
            @include('layouts.newest_comments')
        </div>
    </div><!-- /.row -->
@endsection
