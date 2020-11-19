<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Article;
use App\Models\Category;
use App\Models\Tag;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;
use Illuminate\Mail\Markdown;
use Illuminate\Support\Facades\Auth;

class ArticleController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Article(['tags', 'category']), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('title');
            $grid->column('author');
            $grid->column('keywords');
            $grid->column('order');
            $grid->column('views');
            $grid->column('category.name', trans('category.fields.name'));
            $grid->column('tags')->pluck('name')->label('primary', 3);
            $grid->column('is_top')->switch();
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
        return Form::make(new Article(['tags', 'category']), function (Form $form) {
            $form->display('id');

            $form->select('category_id', trans('admin.categories'))
                ->options(function () {
                    return Category::query()->orderBy('order')->pluck('name', 'id');
                })->customFormat(function ($v) {
                    return $v;
                });;
            $form->text('title');
            $form->text('author')->default(Auth::guard('admin')->user()->username);
            $form->multipleSelect('tags', trans('admin.tags'))
                ->options(function () {
                    return Tag::query()->orderBy('order')->pluck('name', 'id');
                })
                ->customFormat(function ($v) {
                    return array_column($v, 'id');
                });
            $form->text('keywords');
            $form->markdown('markdown');
            $form->number('order');
            $form->textarea('description');
            $form->radio('is_top')->options([0 => '否', 1 => '是'])->default(0);
            $form->number('views')->default(0);
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
