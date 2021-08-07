<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Course;
use App\Lecture;
use App\RegisteredCourses;
use App\Quiz;

class RegisteredCoursesController extends Controller
{
    public function index()
    {
        $courses = Auth::user()->registeredCourses()->get();

        return view("student.registered-courses", compact('courses'));
    }

    public function complete_payment(Request $request)
    {
        $validator = $request->validate([
            "name" => "required",
            "card_number" => "required",
            "month_year" => "required",
            "security_code" => "required",
            "zip_code" => "required|numeric",
        ]);

        $register = RegisteredCourses::create([
            "user_id" => Auth::user()->id,
            "course_id" => $request->course_id
        ]);
        if ($register->id) {
            return redirect()->route('user.registered-course')->with('success', "Congratulations! you are successfully enrolled");
        } else {
            return redirect()->back()->with('error', "Err! there was an error please try again");
        }
    }

    public function view($course_id)
    {
        $course = RegisteredCourses::where(['user_id' => Auth::user()->id, 'course_id' => $course_id])->with(["course", "course.lectures", "course.quizzes" => function ($query) {
            $query->where('status_id', 1);
        }, "course.quizzes.userAttempt"])->first()->toArray();
        $course = $course['course'];

        return view("student.view-course", compact('course'));
    }

    public function get_video_url($id)
    {
        $lecture = Lecture::find($id)->toJson();
        return $lecture;
    }
}
