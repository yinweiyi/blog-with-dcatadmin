<footer class="footer">
    <ul class="list-inline">
        @foreach($tags as $tag)
            <li class="cat-item cat-item-342">
                <a href="#" title="{{ $tag }}">{{ $tag }}</a>
            </li>
        @endforeach
    </ul>
    <p> Copyright © 2010-2020
        <a href="https://www.ewayee.com/">{{ $configs['title'] ?? '' }}</a>
        <a href="http://www.beian.miit.gov.cn/" target="_blank" rel="nofollow">{{ $configs['icp'] ?? '' }}</a>
    </p>
</footer>
