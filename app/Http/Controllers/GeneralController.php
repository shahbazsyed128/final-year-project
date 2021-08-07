<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use Illuminate\Support\Facades\Validator;

class GeneralController extends Controller
{
    public function checkout($course_id) {
        $course = Course::find($course_id)->toArray();
        return view("student.checkout", compact('course'));
    }
}
