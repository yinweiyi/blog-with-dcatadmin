<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Article;
use App\Models\Category;
use App\Models\Tag;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
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
            $grid->column('title')->display(function ($title) {
                return sprintf('<a href="%s" target="_blank">%s</a>', route('article.show', ['slug' => $this->slug]), $title);
            });
            $grid->column('slug');
            $grid->column('author');
            $grid->column('keywords');
            $grid->column('order')->sortable();
            $grid->column('views');
            $grid->column('category.name', trans('category.fields.name'));
            $grid->column('tags')->pluck('name')->label('primary', 3);
            $grid->column('is_top')->switch();
            $grid->column('is_show')->switch();
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
                })->required();
            $form->text('title')->required();
            $form->text('slug')->required()->rules('required|regex:/^[\d\w-]{1,50}$/', [
                'regex' => 'slug必须为1-50位数字、字母或中横线',
            ]);
            $form->text('author')->default(Auth::guard('admin')->user()->username);
            $form->multipleSelect('tags', trans('admin.tags'))
                ->options(function () {
                    return Tag::query()->orderBy('order')->pluck('name', 'id');
                })
                ->customFormat(function ($v) {
                    return array_column($v, 'id');
                });
            $form->text('keywords')->required();

            $form->radio('content_type')
                ->when(1, function (Form $form) {
                    $form->markdown('markdown')->height(800);
                })
                ->when(2, function (Form $form) {
                    $form->editor('html');
                })
                ->options([1 => 'markdown', 2 => '编辑器'])
                ->default(1);


            $form->number('order');
            $form->textarea('description');
            $form->radio('is_top')->options(['否', '是'])->default(0);
            $form->radio('is_show')->options(['否', '是'])->default(1);
            $form->number('views')->default(0);
            $form->display('created_at');
            $form->display('updated_at');
        })->saving(function (Form $form) {
            if ($form->content_type == 1 && $form->markdown) {
                $html = Markdown::parse($form->markdown);
                $form->html = $html;
            }
        });
    }
}
