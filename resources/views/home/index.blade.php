@extends('master')

@section('container')
    <div class="row">
        <div class="col-md-8">
            @if(!is_null($sentence))
                <div class="well quote">
                <span class="quote-headtips" style="color: rgb(72, 175, 124);">每日一句 ( {{ $sentence->created_at->format('Y-m-d') }} ) &nbsp;
                    <span class="glyphicon glyphicon-bullhorn"></span>
                </span>
                    <p>{{ $sentence->content }}</p>
                    <p>{{ $sentence->translation }}<span class="pull-right">———— {{ $sentence->author }}</span></p>
                </div>
            @endif
            <div class="panel panel-index-left">
                @foreach($articles as $article)
                    <div class="panel-body">
                        <h2 class="blog-post-title">
                            <a href="{{ route('home.article', ['id' => $article->id]) }}">{{ $article->title }}</a>
                        </h2>
                        <p> {{ $article->stripTagHtml() }}</p>
                    </div>
                    <div class="panel-footer">发布于{{ $article->created_at->format('Y-m-d') }}&nbsp;|&nbsp;
                        浏览：{{ $article->views }}&nbsp;|&nbsp;Tags：
                        @foreach($article->tags as $tag)
                            <a href="{{ route('home.index_tag', ['id' => $tag->id]) }}" rel="tag">{{ $tag->name }}</a>
                        @endforeach
                    </div>
                @endforeach
            </div>
            <ul class="pagination">
                {{ $articles->render() }}
            </ul>
        </div><!-- /.blog-main -->
        <div class="col-md-4">
            @include('layouts.tags')
            @include('layouts.hots')
            @include('layouts.new_comments')
            @include('layouts.friendship_links')
        </div>
    </div><!-- /.row -->
@endsection
