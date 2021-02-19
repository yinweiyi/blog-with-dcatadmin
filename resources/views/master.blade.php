<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
          content="width=device-width, initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
    <meta name="baidu-site-verification" content="code-dn39zmbxqg"/>
    <link rel="icon" href="/favicon.ico">
    <meta name="author" content="{{ $configs['author'] ?? '' }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', $configs['title'] ?? '') | {{$configs['sub_title'] ?? ''}}</title>
    <meta name="keywords" content="{{ $configs['keywords'] ?? '' }},@yield('keywords', '')">
    <meta name="description" content="{{ $configs['description'] ?? '' }}">
    <link href="{{ asset('css/ie10-viewport-bug-workaround.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.min.css') }}" rel="stylesheet">
    @yield('css')
    <!--[if lt IE 9]>
    <script src="../../assets/js/ie8-responsive-file-warning.js"></script>
    <![endif]-->
    <script async="" src="{{ asset('js/analytics.js') }}"></script>
    <script src="{{ asset('js/ie-emulation-modes-warning.js') }}"></script>
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script> <![endif]-->
    {{--    <script data-ad-client="ca-pub-6811262025296014" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>--}}
    <script>
        var _hmt = _hmt || [];
        (function() {
            var hm = document.createElement("script");
            hm.src = "https://hm.baidu.com/hm.js?de207403b7a735be3a83341ba1134867";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    </script>
</head>
<body>
@include('layouts.nav')
<div class="container main">
    @yield('container')
</div>
@include('layouts.footer')

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/ie10-viewport-bug-workaround.js') }}"></script>
<script src="{{ asset('js/zx.js') }}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@yield('js')
</body>
</html>
