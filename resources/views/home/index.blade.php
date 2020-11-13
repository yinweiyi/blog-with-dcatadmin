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
                <div class="panel-body">
                    <h2 class="blog-post-title">
                        <a href="https://www.ewayee.com/bokefuwuqiqianyi.html">服务器迁移，博客已无缝切换</a>
                    </h2>
                    <p> 原服务器还一天到期，续费还不如新购来的划算，所以直接换了台新的，赶紧转移数据。当你看到这条信息时，我已把博客迁移到新的服务器。</p>
                </div>
                <div class="panel-footer">发布于2020-08-23&nbsp;|&nbsp; 浏览：954&nbsp;|&nbsp;Tags： <a href="#" rel="tag">laravel</a>
                </div>
            </div>
            <ul class="pagination">
                <li class="active"><span>1</span></li>
                <li><a href="https://www.ewayee.com/page/2">2</a></li>
                <li><a href="https://www.ewayee.com/page/3">3</a></li>
                <li><a href="https://www.ewayee.com/page/4">4</a></li>
                <li><a href="https://www.ewayee.com/page/2" class="page_next">下一页</a></li>
                <li><a href="https://www.ewayee.com/page/66">最后</a></li>
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
