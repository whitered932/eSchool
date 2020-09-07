<?php

namespace App\Admin\Controllers;

use App\Grade;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Widgets\Table;
use App\Admin\Selectable\Teacher;

class GradeController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Классы';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Grade());

        $grid->column('id', __('Номер'))->filter()->width(100)->sortable();
        $grid->column('title', __('Название'))->sortable()->width(120)->help('Аббревиатура класса. Например: 5А')->editable();
        $grid->column('teacher.name', __('Классный руководитель'))->width(200);
        $grid->column('students', 'Кол-во учеников')->display(function ($students) {
            return count($students);
        })->help('Количество учеников в классе')->expand(function ($model) {
            $students = $model->students()->take(10)->get()->map(function ($students) {
                return $students->only(['id', 'name', 'birthday', 'created_at']);
            });
            return new Table(['ID', 'Имя', 'Дата рождения', 'Запись создана'], $students->toArray());
        });;
        $grid->column('created_at', __('Создано'))->help('Дата создания профиля');
        $grid->column('updated_at', __('Обновлено'))->help('Дата обновления профиля');

        $grid->filter(function ($filter) {
            $filter->id();
            $filter->like('title', 'Название');
            $filter->like('teacher.name', 'Класс. рук');
            $filter->between('created_at', 'Время создания')->datetime();
            $filter->between('updated_at', 'Время обновления')->datetime();
        });



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
        $show = new Show(Grade::findOrFail($id));

        $show->id('ID');
        $show->title('Название');
        $show->created_at('Создано');
        $show->updated_at('Обновлено');

        $show->students('Ученики', function ($student) {

            $student->setResource('/admin/students');

            $student->name('ФИО');
            $student->birthday('Дата рождения');

            $student->filter(function ($filter) {
                $filter->like('name');
            });

        });

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Grade());

        $form->text('title', __('Title'));

        return $form;
    }
}
