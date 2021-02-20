<?php

namespace App\Admin\Controllers;

use App\Admin\Renderable\CommentTable;
use App\Admin\Repositories\Guestbook;
use App\Models\Comment;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;
use Illuminate\Mail\Markdown;

class GuestbookController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Guestbook(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('html')->display(function ($html) {
                return strip_tags($html);
            })->substr(0, 60);
            $grid->column('can_comment')->switch();
            $grid->column('comments', '评论列表')->display('评论列表')->modal('评论列表', function () {
                return CommentTable::make(['commentable_id' => $this->id, 'commentable_type' => Comment::Types['guestbook']]);
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
        return Form::make(new Guestbook(), function (Form $form) {
            $form->display('id');
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
            $form->switch('can_comment')->default(1);

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
