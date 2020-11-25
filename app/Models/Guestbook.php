<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class Guestbook extends Model
{
    use HasDateTimeFormatter;

    protected $table = 'guestbook';

    protected $casts = ['is_top' => 'boolean'];
    /** 评论
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
