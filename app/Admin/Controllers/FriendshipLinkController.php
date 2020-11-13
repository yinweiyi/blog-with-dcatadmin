<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\FriendshipLink;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class FriendshipLinkController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new FriendshipLink(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('description');
            $grid->column('is_enable');
            $grid->column('link');
            $grid->column('title');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();
        
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
        
            });
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
        return Show::make($id, new FriendshipLink(), function (Show $show) {
            $show->field('id');
            $show->field('description');
            $show->field('is_enable');
            $show->field('link');
            $show->field('title');
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
        return Form::make(new FriendshipLink(), function (Form $form) {
            $form->display('id');
            $form->text('description');
            $form->text('is_enable');
            $form->text('link');
            $form->text('title');
        
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
