<?php

namespace App\Admin\Controllers;

use App\Admin\Selectable\Grade;
use App\Student;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class StudentController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Ученики';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Student());

        $grid->column('id', __('Номер'));
        $grid->column('name', __('ФИО'));
        $grid->column('birthday', __('Дата рождения'));
        $grid->column('grade.title', __('Класс'))->sortable();
        $grid->column('created_at', __('Профиль создан'));
        $grid->column('updated_at', __('Профиль обновлен'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Student::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('birthday', __('Birthday'));
        $show->field('grade.title', __('Класс'));
        $show->field('created_at', __('Профиль создан'));
        $show->field('updated_at', __('Профиль обновлён'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Student());

        $form->text('name', __('Name'));
        $form->date('birthday', __('Birthday'))->default(date('Y-m-d'));
        $form->belongsTo('grade_id', Grade::class, 'Класс');
//        $form->number('grade_id', __('Grade id'));

        return $form;
    }
}
