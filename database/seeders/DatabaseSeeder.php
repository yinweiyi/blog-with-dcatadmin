<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Config;
use App\Models\Tag;
use Dcat\Admin\Models\Menu;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        Menu::query()->insert([
                ['id' => 8, 'parent_id' => 0, 'order' => 8, 'title' => 'Article', 'icon' => 'fa-book', 'uri' => null, 'created_at' => date('Y-m-d H:i:s')],
                ['id' => 9, 'parent_id' => 8, 'order' => 9, 'title' => 'Articles', 'icon' => null, 'uri' => '/articles', 'created_at' => date('Y-m-d H:i:s')],
                ['id' => 10, 'parent_id' => 8, 'order' => 10, 'title' => 'Tags', 'icon' => null, 'uri' => '/tags', 'created_at' => date('Y-m-d H:i:s')],
                ['id' => 11, 'parent_id' => 0, 'order' => 18, 'title' => 'Other', 'icon' => 'fa-building-o', 'uri' => null, 'created_at' => date('Y-m-d H:i:s')],
                ['id' => 12, 'parent_id' => 16, 'order' => 13, 'title' => 'Friendship Links', 'icon' => null, 'uri' => '/friendship-links', 'created_at' => date('Y-m-d H:i:s')],
                ['id' => 13, 'parent_id' => 11, 'order' => 19, 'title' => 'Sentences', 'icon' => null, 'uri' => '/sentences', 'created_at' => date('Y-m-d H:i:s')],
                ['id' => 14, 'parent_id' => 17, 'order' => 15, 'title' => 'Configs', 'icon' => null, 'uri' => '/configs', 'created_at' => date('Y-m-d H:i:s')],
                ['id' => 15, 'parent_id' => 8, 'order' => 11, 'title' => 'Categories', 'icon' => null, 'uri' => '/categories', 'created_at' => date('Y-m-d H:i:s')],
                ['id' => 16, 'parent_id' => 0, 'order' => 12, 'title' => 'Friendship Link', 'icon' => 'fa-link', 'uri' => null, 'created_at' => date('Y-m-d H:i:s')],
                ['id' => 17, 'parent_id' => 0, 'order' => 14, 'title' => 'Config', 'icon' => 'fa-gear', 'uri' => null, 'created_at' => date('Y-m-d H:i:s')],
                ['id' => 18, 'parent_id' => 17, 'order' => 16, 'title' => 'Abouts', 'icon' => 'fa-user-o', 'uri' => '/abouts', 'created_at' => date('Y-m-d H:i:s')],
                ['id' => 19, 'parent_id' => 17, 'order' => 17, 'title' => 'Guestbook', 'icon' => 'fa-book', 'uri' => '/guestbook', 'created_at' => date('Y-m-d H:i:s')],
                ['id' => 20, 'parent_id' => 0, 'order' => 20, 'title' => 'Comment', 'icon' => 'fa-comment-o', 'uri' => null, 'created_at' => date('Y-m-d H:i:s')],
                ['id' => 21, 'parent_id' => 20, 'order' => 21, 'title' => 'Comments', 'icon' => null, 'uri' => '/comments', 'created_at' => date('Y-m-d H:i:s')]]
        );

        Tag::query()->insert([
            ['name' => 'PHP', 'order' => 1, 'created_at' => date('Y-m-d H:i:s')],
            ['name' => 'Composer', 'order' => 2, 'created_at' => date('Y-m-d H:i:s')],
        ]);

        Category::query()->insert([
            ['name' => '新闻资讯', 'order' => 1, 'created_at' => date('Y-m-d H:i:s')],
            ['name' => '幽默搞笑', 'order' => 2, 'created_at' => date('Y-m-d H:i:s')],
            ['name' => '技术分享', 'order' => 3, 'created_at' => date('Y-m-d H:i:s')],
        ]);

        Config::query()->insert([
            'title'       => '个人博客',
            'sub_title'   => '个人博客',
            'keywords'    => '个人博客',
            'icp'         => '',
            'author'      => 'ewayee',
            'description' => 'ewayee的个人博客',
            'created_at'  => date('Y-m-d H:i:s')
        ]);
    }
}
