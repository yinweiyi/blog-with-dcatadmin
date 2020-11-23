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
            $grid->column('id')->sortable();
            $grid->column('content');
            $grid->column('nickname');
            $grid->column('email');
            $grid->column('commentable')->display(function ($item) {
                return $item['name'] ?? $item['title'] ?? '评论';
            });
            $grid->column('is_audited')->switch();
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('ID');
                $filter->like('content');
                $commentableTypes = \App\Models\Comment::query()->pluck('commentable_type','commentable_type');
                $filter->equal('commentable_type')->select($commentableTypes);
            });

            $grid->disableCreateButton();
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
        return Show::make($id, new Comment(), function (Show $show) {
            $show->field('id');
            $show->field('parent_id');
            $show->field('content');
            $show->field('nickname');
            $show->field('email');
            $show->field('commentable_id');
            $show->field('commentable_type');
            $show->field('is_audited');
            $show->field('top_id');
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
        return Form::make(new Comment(), function (Form $form) {
            $form->display('id');
            $form->text('parent_id');
            $form->text('content');
            $form->text('nickname');
            $form->text('email');
            $form->text('commentable_id');
            $form->text('commentable_type');
            $form->text('is_audited');
            $form->text('top_id');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
