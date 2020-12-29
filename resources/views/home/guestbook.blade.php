@extends('master')

@section('container')
    <div class="row">
        <div class="col-md-8 blog-main">
            <div id="article" class="well">
                {!! $guestbook->html ?? '欢迎灌水交流，别看我长时间不发博，博主可一直都在线~' !!}
            </div><!-- /.blog-main -->

            @if($guestbook)
                <div id="comments" style="height: auto !important;">
                    <h3> 留言 : 目前有 {{ $guestbook->comments_count }} 条评论</h3>
                    @include('layouts.comments')
                </div>
                @if($guestbook->can_comment)
                    @include('layouts.comment', ['id' => $guestbook->id, 'type' => 'guestbook'])
                @endif
            @endif
        </div>
        <div class="col-md-4">
            @include('layouts.tags')
            @include('layouts.hots')
            @include('layouts.newest_comments')
        </div>

    </div><!-- /.row -->
@endsection
