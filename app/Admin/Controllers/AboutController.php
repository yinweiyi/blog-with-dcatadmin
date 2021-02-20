<?php

namespace App\Admin\Controllers;

use App\Admin\Renderable\CommentTable;
use App\Admin\Repositories\About;
use App\Models\Comment;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;
use Illuminate\Mail\Markdown;

class AboutController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new About(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('title');
            $grid->column('order');
            $grid->column('is_enable')->switch();
            $grid->column('comments', '评论列表')->display('评论列表')->modal('评论列表', function () {
                return CommentTable::make(['commentable_id' => $this->id, 'commentable_type' => Comment::Types['about']]);
            });
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();
            $grid->disableViewButton();
            $grid->disablePagination();
        });
    }


    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new About(), function (Form $form) {
            $form->display('id');
            $form->text('title');
            $form->radio('content_type')
                ->when(1, function (Form $form) {
                    $form->markdown('markdown');
                    $form->hidden('html');
                })
                ->when(2, function (Form $form) {
                    $form->editor('html');
                })
                ->options([1 => 'markdown', 2 => '编辑器'])
                ->default(1);
            $form->number('order')->default(1);
            $form->radio('is_enable')->options([0 => '否', 1 => '是'])->default(1);
            $form->display('created_at');
            $form->display('updated_at');
            $form->disableViewCheck();
        })->saving(function (Form $form) {
            if ($form->content_type == 1 && $form->markdown) {
                $html = Markdown::parse($form->markdown);
                $form->html = $html;
            }
        });
    }
}
