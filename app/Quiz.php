<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Quiz extends Model
{
    protected $guarded = [];

    public function course() {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function status() {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function questions() {
        return $this->hasMany(Question::class, 'quiz_id')->with('options');
    }

    public function options() {
        return $this->hasManyThrough(Option::class, Question::class);
    }

    public function userAttempt() {
        return $this->hasMany(UserQuizAttempt::class)->where('user_id', Auth::user()->id);
    }
}
