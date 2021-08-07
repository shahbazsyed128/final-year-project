<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $guarded = [];
    public function quiz() {
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }

    public function status() {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function options() {
        return $this->hasMany(Option::class, 'question_id');
    }
}
