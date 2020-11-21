<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request)
    {
        $model = Comment::Types[$request->type];

        $article = $model::find($request->id);

        if (is_null($article)) return $this->error('评论的文章不存在');
        $attributes = $request->only(['parent_id', 'content', 'nickname', 'email']);

        if ($attributes['parent_id'] > 0) {
            $parent = Comment::query()->where(['commentable_id' => $article->id, 'commentable_type' => get_class($article)])->find($attributes['parent_id']);
            if (is_null($parent)) return $this->error('要回复的评论不存在');
            $attributes['top_id'] = $parent->top_id ?: $parent->id;
        }

        $comment = $article->comments()->create($attributes);

        return $comment->exists() ? $this->success('评论成功', ['comment_id' => $comment->id]) : $this->error('评论失败，请重试');
    }
}
