<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasDateTimeFormatter;

    protected $fillable = ['parent_id',
        'content',
        'nickname',
        'email',
        'commentable_id',
        'commentable_type',
        'is_audited',
        'top_id'
    ];

    const Types = [
        'article'   => Article::class,
        'about'     => About::class,
        'guestbook' => Guestbook::class,
    ];

    /**
     * 获取拥有此评论的模型
     */
    public function commentable()
    {
        return $this->morphTo();
    }
}
