<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Job;

class Application extends Model
{
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function job() {
        return $this->belongsTo(Job::class, 'job_id');
    }
}
