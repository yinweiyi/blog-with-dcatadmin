<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Dcat\Admin\Admin;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');

    $router->resource('/articles', 'ArticleController');
    $router->resource('/configs', 'ConfigController');
    $router->resource('/friendship-links', 'FriendshipLinkController');
    $router->resource('/sentences', 'SentenceController');
    $router->resource('/categories', 'CategoryController');
    $router->resource('/tags', 'TagController');
    $router->resource('/abouts', 'AboutController');
    $router->resource('/guestbook', 'GuestbookController');
    $router->resource('/comments', 'CommentController');
});
