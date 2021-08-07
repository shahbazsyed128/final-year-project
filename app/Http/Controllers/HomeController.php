<?php

namespace App\Http\Controllers;

use App\Course;
use App\Job;
use App\Lecture;
use App\Quiz;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Gate::allows('isMentor')) {
            $total_sold = Course::where('author_id',Auth::user()->id)->withCount('coursesSold')->get()->map(function($item){
                return ($item->price * $item->courses_sold_count);
            })->sum();
        }
        if (Gate::allows('isAdmin')) {
            $data = array(
                'user-registered' => User::where('role', 'user')->count(),
                'users-pending' => User::where('status', 0)->count(),
                'pending-users' =>  User::where(['status' => 0])->get()->count(),
                'total-quiz' => Quiz::get()->count(),
                'active-quiz' => Quiz::where('status_id', 1)->get()->count(),
                'inactive-quiz' => Quiz::where('status_id', 0)->get()->count(),
                'total-courses' => Course::get()->count(),
                'active-courses' => Course::where('status', 1)->get()->count(),
                'inactive-courses' => Course::where('status', 0)->get()->count(),
                'companies-registered' => User::where('role', 'company')->get()->count(),
                'lectures-uploaded' => Lecture::get()->count(),
                'courses-sold' => User::find(Auth::user()->id)->courses_sold()->count(),
                'sales' => $total_sold,
            );
        } else if (Gate::allows('isUser')) {
            $data = array(
                'course-enrolled' => User::find(Auth::user()->id)->registeredCourses()->count(),
                'course-completed' => User::find(Auth::user()->id)->user_succeed_courses()->count(),
                'course-published' => User::find(Auth::user()->id)->courses()->count(),
            );
        } else if (Gate::allows('isCompany')) {
            $data = array(
                'job-posted' => Job::where('company_id', Auth::user()->id)->count(),
                'hired' => User::find(Auth::user()->id)->users()->count(),
            );
        }
        return view('home', compact('data'));
    }
}
