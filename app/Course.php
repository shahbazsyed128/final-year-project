<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use Illuminate\Support\Facades\Auth;

class Course extends Model
{
    protected $fillable = [
        'author_id', 'name','status','category_id','subject', 'summary','description','lectures','price',
    ];

    public function lectures() {
        return $this->hasMany(Lecture::class);
    }

    public function quizzes() {
        return $this->hasMany(Quiz::class);
    }

    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function registeredCourse() {
        return $this->hasMany(RegisteredCourses::class)->where('user_id', Auth::user()->id);
    }

    public function coursesSold() {
        return $this->hasMany(RegisteredCourses::class);
    }
    
}
