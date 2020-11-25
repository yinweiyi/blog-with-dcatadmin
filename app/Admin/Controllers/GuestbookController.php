<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Guestbook;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;
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
            $grid->column('markdown')->display(function ($markdown) {
                return strip_tags($markdown);
            })->substr(0, 60);
            $grid->column('can_comment')->switch();
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();
            $grid->disableViewButton();
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
            $form->markdown('markdown');
            $form->hidden('html');
            $form->switch('can_comment')->default(1);

            $form->display('created_at');
            $form->display('updated_at');
        })->saving(function (Form $form) {
            if ($form->markdown) {
                $html = Markdown::parse($form->markdown);
                $form->html = $html;
            }
        });
    }
}
