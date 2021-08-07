<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class LectureComment extends Model
{
    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
