<?php

namespace App\Admin\Forms;

use App\Models\Comment;
use Dcat\Admin\Widgets\Form;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Reply extends Form
{
    //use LazyWidget;
    /**
     * Handle the form request.
     *
     * @param array $input
     *
     * @return Response
     */
    public function handle(array $input)
    {
        $admin = Auth::guard('admin')->user();

        $comment = Comment::query()->create([
            'parent_id'        => $input['id'],
            'content'          => $input['reply'],
            'avatar'           => 'storage/' . $admin->avatar,
            'nickname'         => $admin->name,
            'email'            => '378772944@qq.com',
            'commentable_id'   => $input['commentable_id'],
            'commentable_type' => $input['commentable_type'],
            'ip'               => request()->ip(),
            'is_read'          => 1,
            'is_admin_reply'   => 1,
            'top_id'           => $input['top_id'] ?: $input['id'],

        ]);

        return $comment->exists() ? $this->success('Reply Successfully.', '/comments') : $this->error('Reply Error');
    }

    /**
     * Build a form here.
     */
    public function form()
    {
        $this->display('nickname');
        $this->display('email');
        $this->display('content');
        $this->hidden('commentable_id');
        $this->hidden('commentable_type');
        $this->hidden('top_id');
        $this->hidden('parent_id');
        $this->hidden('id');

        $this->textarea('reply')->required()->placeholder('输入回复内容');
    }

    /**
     * The data of the form.
     *
     * @return array
     */
    public function default()
    {
        return $this->data()->toArray();
    }
}
