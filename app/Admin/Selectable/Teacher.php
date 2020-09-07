<?php


namespace App\Admin\Selectable;
use Encore\Admin\Grid\Selectable;
use Encore\Admin\Grid\Filter;
use App\Teacher as T;

class Teacher extends Selectable
{
    public $model = T::class;

    public function make()
    {
        $this->column('id');
        $this->column('name');
        $this->filter(function (Filter $filter) {
            $filter->like('name');
        });
    }
}
