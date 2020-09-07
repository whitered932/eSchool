<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
}
