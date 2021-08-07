<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSucceedCourse extends Model
{
    protected $fillable = ['user_id', 'course_id'];

    public function course() {
        return $this->belongsTo(Course::class);
    }

    public function categories() {
        return $this->hasManyThrough(Category::class, Course::class, 'id','id', 'course_id', 'category_id');
    }
}
