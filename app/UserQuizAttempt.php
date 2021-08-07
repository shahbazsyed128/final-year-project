<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserQuizAttempt extends Model
{
    protected $guarded = [];

    public function quiz() {
        return $this->belongsTo(\App\Quiz::class);
    }
    
    public function QuizQuestions() {
        return $this->hasMany(\App\UserQuizQuestion::class, "attemptId");
    }
    
}
