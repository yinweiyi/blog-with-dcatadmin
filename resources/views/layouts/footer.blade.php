<footer class="footer">
    <ul class="list-inline">
        @foreach($categories as $slug => $category)
            <li class="cat-item cat-item-342">
                <a href="{{ route('home.index_category', ['category' => $slug]) }}" title="{{ $category }}">{{ $category }}</a>
            </li>
        @endforeach
    </ul>
    <p> Copyright © 2010-2020
        <a href="https://www.ewayee.com/">{{ $configs['title'] ?? '' }}</a>
        <a href="http://www.beian.miit.gov.cn/" target="_blank" rel="nofollow">{{ $configs['icp'] ?? '' }}</a>
    </p>
</footer>
