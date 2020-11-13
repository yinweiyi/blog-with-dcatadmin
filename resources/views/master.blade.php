<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
          content="width=device-width, initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
    <meta name="baidu-site-verification" content="BHraSigcd3">
    <link rel="icon" href="/favicon.ico">
    <meta name="author" content="忆未乙技术博客">
    <title>@yield('title', '忆未乙个人博客') | 技术博客</title>
    <meta name="keywords" content="个人博客,个人博客网站,个人网站,博客网站,忆未乙">
    <meta name="description" content="忆未乙的技术博客，记录工作学习过程中遇到问题经验。这是忆未乙技术博客的原创博文">
    <link href="{{ asset('css/ie10-viewport-bug-workaround.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    @yield('css')
    <!--[if lt IE 9]>
    <script src="../../assets/js/ie8-responsive-file-warning.js"></script>
    <![endif]-->
    <script async="" src="{{ asset('js/analytics.js') }}"></script>
    <script src="{{ asset('js/ie-emulation-modes-warning.js') }}"></script>
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script> <![endif]--> </head>
<body>
@include('layouts.nav')
<div class="container main">
    @yield('container')
</div>

<script src="{{ asset('jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/ie10-viewport-bug-workaround.js') }}"></script>
<script src="{{ asset('js/zx.js') }}"></script>
@yield('js')
</body>
</html>
