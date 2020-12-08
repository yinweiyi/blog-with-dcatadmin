@if(!$hots->isEmpty())
    <div class="panel panel-default">
        <div class="panel-heading"> 最近热门</div>
        <ul class="list-group">
            @foreach($hots as $hot)
                <li class="list-group-item">
                    <a href="{{ route('article.show',['slug' => $hot->slug]) }}" rel="bookmark"
                       title="详细阅读 {{ $hot->title }}">
                        {{ $hot->title }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endif
