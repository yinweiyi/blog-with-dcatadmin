<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Config;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class ConfigController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Config(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('title');
            $grid->column('sub_title');
            $grid->column('keywords');
            $grid->column('icp');
            $grid->column('author');
            //$grid->column('description');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
            });
            $grid->disableViewButton();
            $grid->disableBatchDelete();
            $grid->disableDeleteButton();
            $grid->disableCreateButton();
            $grid->disablePagination();
            $grid->disableFilterButton();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Config(), function (Form $form) {
            $form->display('id');
            $form->text('title');
            $form->text('sub_title');
            $form->text('keywords');
            $form->text('icp');
            $form->text('author');
            $form->text('description');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
