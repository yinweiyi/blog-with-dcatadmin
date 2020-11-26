<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Dcat\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasDateTimeFormatter, ModelTree;

    protected $fillable = [
        'parent_id',
        'content',
        'avatar',
        'nickname',
        'email',
        'commentable_id',
        'commentable_type',
        'ip',
        'is_read',
        'is_admin_reply',
        'is_audited',
        'top_id'
    ];

    // 返回空值即可禁用 order 字段
    public function getOrderColumn()
    {
        return null;
    }

    const Types = [
        'article'   => Article::class,
        'about'     => About::class,
        'guestbook' => Guestbook::class,
    ];

    protected $titleColumn = 'content';

    /**
     * 获取拥有此评论的模型
     */
    public function commentable()
    {
        return $this->morphTo();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    public function top()
    {
        return $this->belongsTo(Comment::class, 'top_id');
    }
}
