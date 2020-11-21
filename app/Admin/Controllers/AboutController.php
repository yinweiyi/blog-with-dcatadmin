<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\About;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;
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
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');

            });

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
        return Form::make(new About(), function (Form $form) {
            $form->display('id');
            $form->text('title');
            $form->markdown('markdown');
            $form->hidden('html');
            $form->number('order')->default(1);
            $form->radio('is_enable')->options([0 => '否', 1 => '是'])->default(1);
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
