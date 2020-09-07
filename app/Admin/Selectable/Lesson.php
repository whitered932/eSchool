<?php

namespace App\Admin\Selectable;
use Encore\Admin\Grid\Selectable;
use App\Lesson as L;
use Encore\Admin\Grid\Filter;

class Lesson extends Selectable
{
    public $model = L::class;

    public function make()
    {
        $this->column('id');
        $this->column('title');
        $this->filter(function (Filter $filter) {
            $filter->like('title');
        });
    }
}
