<?php

namespace App\Admin\Controllers;

use App\Admin\Selectable\Grade;
use App\Admin\Selectable\Lesson;
use App\Teacher;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class TeacherController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Учителя';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Teacher());

        $grid->quickSearch('name');

        $grid->column('id', __('Номер'));
        $grid->column('name', __('ФИО'))->editable();
        $grid->column('birthday', __('Дата рождения'));
        $grid->column('lesson.title', __('Урок'));
        $grid->column('grade.title', __('Класс'));
        $grid->column('created_at', __('Запись создана'));
        $grid->column('updated_at', __('Запись обновлена'));

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
        $show = new Show(Teacher::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('birthday', __('Birthday'));
        $show->field('lesson_id', __('Lesson id'));
        $show->field('grade_id', __('Grade id'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Teacher());

        $form->text('name', __('Name'));
        $form->date('birthday', __('Birthday'))->default(date('Y-m-d'));
        $form->belongsTo('lesson_id', Lesson::class, 'Урок');
        $form->belongsTo('grade_id', Grade::class, 'Класс');

        return $form;
    }
}
