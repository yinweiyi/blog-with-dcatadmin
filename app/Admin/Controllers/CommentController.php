<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Comment;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class CommentController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {

        return Grid::make(new Comment(['commentable']), function (Grid $grid) {

            $grid->quickSearch('content');
            $grid->column('id')->bold()->sortable();
            $grid->column('nickname');
            $grid->column('email');
            $grid->column('content')->tree(); // 开启树状表格功能
            $grid->column('commentable')->display(function ($item) {
                return $item['name'] ?? $item['title'] ?? '评论';
            });
            $grid->column('ip');
            $grid->column('is_audited')->switch();
            $grid->column('is_read')->switch();
            $grid->column('created_at');

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('ID');
                $filter->equal('is_read')->radio(['否', '是']);
                $filter->like('content');
                $commentableTypes = \App\Models\Comment::query()->pluck('commentable_type','commentable_type');
                $filter->equal('commentable_type')->select($commentableTypes);
            });

            //$grid->column('reply')->show;

            $grid->disableCreateButton();
            $grid->disableViewButton();
            $grid->paginate(10);
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new Comment(['parent', 'top']), function (Show $show) {
            $show->field('id');
            $show->field('parent.content');
            $show->field('top.content');
            $show->field('nickname');
            $show->field('email');
            $show->field('content');
            $show->field('commentable_id');
            $show->field('commentable_type');
            $show->field('is_audited');
            $show->field('created_at');
            $show->field('updated_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Comment('commentable'), function (Form $form) {
            $form->display('id');
            $form->display('top_id');
            $form->display('commentable')->with(function ($item) {
                return $item['name'] ?? $item['title'] ?? '评论';
            });
            $form->text('parent_id');
            $form->text('nickname');
            $form->text('email');
            $form->display('ip');
            $form->textarea('content');
            $form->switch('is_audited');
            $form->switch('is_read');
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
