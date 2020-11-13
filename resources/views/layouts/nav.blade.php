<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-navbar-collapse" aria-expanded="false"><span class="sr-only">下拉菜单</span> <span
                    class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span></button>
            <a href="{{ route('home.index') }}" class="navbar-brand">{{ $configs['title'] ?? '博客' }} | 技术博客</a></div>
        <div class="collapse navbar-collapse" id="bs-navbar-collapse">
            <ul class="nav navbar-nav top-navbar-nav">
                <li class="active"><a href="{{ route('home.index') }}">首页</a></li>
                {{--                <li><a href="https://www.ewayee.com/sitemap.html">地图</a></li>--}}
                <li><a href="{{ route('home.about') }}">关于</a></li>
                <li><a href="{{ route('home.guest_book') }}">留言</a></li>
            </ul>
            <form id="search-form" class="navbar-form navbar-right" role="search" target="_blank"
                  action="{{ route('home.index') }}" method="get">
                <div class="form-group">
                    <input type="text" id="q" name="q" class="form-control" data-provide="typehead" autocomplete="off"
                           placeholder="输入关键词查找">
                </div>
                <button type="submit" class="btn btn-default" id="submitsearch">搜索</button>
            </form>
        </div>
    </div>
</nav>
