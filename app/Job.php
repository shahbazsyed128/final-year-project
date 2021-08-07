<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\Application;
use Illuminate\Support\Facades\Auth;

class Job extends Model
{
    protected $fillable = [
        'name','status','category_id','subject','description','company_id',
    ];

    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function company() {
        return $this->belongsTo(User::class, 'company_id');
    }

    public function userApplication()
    {
        return $this->belongsToMany(User::class, "job_applications")->withPivot('status')->withTimestamps();
    }
}
