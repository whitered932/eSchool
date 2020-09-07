<?php


namespace App\Admin\Selectable;

use Encore\Admin\Grid\Selectable;
use Encore\Admin\Grid\Filter;
use App\Grade as G;

class Grade extends Selectable
{
    public $model = G::class;

    public function make()
    {
        $this->column('id');
        $this->column('title');

        $this->filter(function (Filter $filter) {
            $filter->like('title');
        });

    }


}
