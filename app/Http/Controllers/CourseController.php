<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Category;
use App\lecture;
use App\UserSucceedCourse;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Course::where('author_id', Auth::user()->id)->orderBy('id', 'DESC')->with('category')->paginate(5);

        return view('courses.courses', compact('data'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**99
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::allows('isAdmin')) {
            $categories = Category::all();
        }
        if (Gate::allows('isUser')) {
            $categories = UserSucceedCourse::where('user_id', Auth::user()->id)->with(['categories'])->get()->pluck('categories');
        }
        return view('courses.create', compact('categories'));
    }


    public function fileUploadPost(Request $request)
    {
        $request->validate([
            'file' => 'required',
        ]);
        $fileName = time() . '.' . request()->file->getClientOriginalExtension();
        request()->file->move(public_path('files'), $fileName);
        return response()->json(['success' => 'You have successfully upload file.', 'filename' => $fileName]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      => 'required|string|min:4|max:191',
            'summary' => 'required|string|min:8',
            'description' => 'required|string|min:8',
            'category_id'      => 'required',
            'subject'   => 'required|string|min:4|max:50',
        ]);
        $course = Course::create([
            'author_id' => Auth::user()->id,
            'name' => $request['name'],
            'summary' => $request['summary'],
            'description' => $request['description'],
            'category_id' => $request['category_id'],
            'subject' => $request['subject'],
            'status' => $request['status'],
            'price'  => $request['price']
        ]);
        if (isset($request['video_title']) && isset($request['video_path']) && (count($request['video_title']) == count($request['video_path']))) {
            foreach ($request['video_title'] as $key => $video_title) {
                Lecture::create([
                    'video_path' => $request['video_path'][$key],
                    'video_title' => $request['video_title'][$key],
                    'course_id' =>  $course->id,
                ]);
            }
        }
        return redirect('courses')->with('success', 'Course Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = Course::find($id);
        $lectures = Lecture::where('course_id', $id)->get()->toArray();
        $course->lectures = $lectures;

        return view('courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = Course::find($id);
        $lectures = Lecture::all()->where('course_id', $id);
        $course->lectures = $lectures;
        $categories = Category::all();
        return view('courses.edit', compact('course', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'          => 'required|string|min:4|max:191',
            'summary'   => 'required|string|min:8',
            'description'   => 'required|string|min:8',
            'category_id'   => 'required|string',
            'subject'       => 'required|string|min:4|max:50',
        ]);
        $course = Course::findOrFail($id);
        $course->update($request->all());
        DB::table('lectures')->where('course_id', $id)->delete();
        if (isset($request['video_title']) && isset($request['video_path']) && (count($request['video_title']) == count($request['video_path']))) {
            foreach ($request['video_title'] as $key => $video_title) {
                Lecture::create([
                    'video_path' => $request['video_path'][$key],
                    'video_title' => $request['video_title'][$key],
                    'course_id' =>  $course->id,
                ]);
            }
        }
        return redirect('courses')->with('success', 'Course updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course =  Course::findOrFail($id);
        $course->delete();
        return redirect('courses')->with('message', 'Course deleted successfully');
    }

    public function viewCourses()
    {
        $courses = Course::where('status', 1)->where('author_id', '!=', Auth::user()->id)->withCount('registeredCourse')->orderBy('id', 'DESC')->paginate(12);
        return view("student.view-courses", compact("courses"));
    }
}
