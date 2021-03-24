<footer class="footer">
    <ul class="list-inline">
        @foreach($categories as $slug => $category)
            <li class="cat-item cat-item-342">
                <a href="{{ route('home.index_category', ['category' => $slug]) }}" title="{{ $category }}">{{ $category }}</a>
            </li>
        @endforeach
    </ul>
    <p> Copyright © 2010-2020
        访问： {{ $visitCount }} 次
        <a href="{{ route('home.index') }}">{{ $configs['title'] ?? '' }}</a>
        <a href="https://www.beian.miit.gov.cn/" target="_blank" rel="nofollow">{{ $configs['icp'] ?? '' }}</a>
        @if($configs['beian'])
            <img src="{{ asset('images/beian.png') }}"/>
            <a target="_blank"
               href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode={{ find_number($configs['beian']) }}"
               style="display:inline-block;text-decoration:none;height:20px;line-height:20px;">
                {{ $configs['beian'] }}
            </a>
        @endif
    </p>
</footer>
