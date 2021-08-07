<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'status', 'role', 'school', 'ssc_group', 'ssc_year', 'ssc_percentage', 'collage', 'hsc_group', 'hsc_year', 'hsc_percentage', 'grad_uni', 'grad_degree', 'grad_year', 'grad_percentage', 'experiences'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function registeredCourses()
    {
        return $this->belongsToMany(Course::class, "registered_courses")->with("lectures");
    }

    public function AttemptedQuiz()
    {
        return $this->hasMany(UserQuizAttempt::class)->with('quiz');
    }

    public function user_succeed_courses()
    {
        return $this->hasMany(UserSucceedCourse::class);
    }

    public function jobApplication()
    {
        return $this->belongsToMany(Job::class, "job_applications")->withPivot('status')->withTimestamps();
    }

    public function company() {
        return $this->belongsToMany(User::class, "hired_users", 'user_id', 'company_id')->withTimestamps();
    }

    public function users() {
        return $this->belongsToMany(User::class, "hired_users", 'company_id', 'user_id')->withTimestamps();
    }

    public function courses() {
        return $this->hasMany(Course::class, 'author_id');
    }

    public function courses_sold() {
        return $this->hasManyThrough(RegisteredCourses::class, Course::class, 'author_id', 'course_id');
    }
}
