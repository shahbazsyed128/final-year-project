<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegisteredCourses extends Model
{
    protected $guarded = [];

    public function course() {
        return $this->belongsTo(Course::class);
    }

    public function quizzes() {
        return $this->hasManyThrough(Quiz::class, Course::class, 'id', 'course_id');
    }
}
