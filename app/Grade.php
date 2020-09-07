<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    public function students()
    {
        return $this->hasMany(Student::class);
    }
    public function teacher()
    {
        return $this->hasOne(Teacher::class, 'grade_id');
    }
}
