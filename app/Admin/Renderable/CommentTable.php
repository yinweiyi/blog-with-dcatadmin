<?php


namespace App\Admin\Renderable;

use App\Admin\Repositories\Comment;
use Dcat\Admin\Grid;
use Dcat\Admin\Grid\LazyRenderable;
use Illuminate\Support\Arr;

class CommentTable extends LazyRenderable
{
    public function grid(): Grid
    {
        return Grid::make(new Comment(['commentable']), function (Grid $grid) {
            $grid->column('id')->sortable('desc');
            $grid->column('nickname', '昵称');
            $grid->column('email');
            $grid->column('content', '内容')->tree(true); // 开启树状表格功能
            $grid->column('ip');
            $grid->column('is_audited', '审核')->display(function ($released) {
                return $released ? '是' : '否';
            });
            $grid->column('is_read', '已读')->display(function ($released) {
                return $released ? '是' : '否';
            });
            $grid->column('created_at');
            $grid->model()->where(Arr::only($this->payload, ['commentable_id', 'commentable_type']));
            $grid->quickSearch(['content']);

            $grid->disableActions();
            $grid->disableRowSelector();
        });
    }
}
