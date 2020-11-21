@foreach($comments as $comment)
    <div class="alert alert-info comments-list" id="comment-{{ $comment['id'] }}">
        <div id="div-comment-4942">
            <div class="comment-author vcard">
                <img src="{{ asset('images/avatar.jpg') }}" alt="用户评论头像" class="img-circle">
                <strong>{{ $comment['nickname'] }}</strong>：
                <span class="datetime">发表于  {{ date('Y年m月d H:i', strtotime($comment['created_at'])) }}
                <span class="reply">
                    <a rel="nofollow" class="comment-reply-link" href="#respond"
                       data-id="{{ $comment['id'] }}" aria-label="回复给{{ $comment['nickname'] }}">[回复]</a>
                </span>
            </span>
            </div>
            <p>{{ $comment['content'] }}</p>
            <div class="clear"></div>
        </div>
        @if(!empty($comment['children']))
            <ul class="children">
                @include('layouts.comments',['comments' => $comment['children']])
            </ul><!-- .children -->
        @endif
    </div>
@endforeach
