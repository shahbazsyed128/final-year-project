<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Job;
use App\Category;
use App\User;
use App\UserSucceedCourse;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $data = Job::orderBy('id', 'DESC')->with('category')->where('company_id', auth()->user()->id)->paginate(5);
        return view('jobs.jobs', compact('data'))->with('i', ($request->input('page', 1) - 1) * 5);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('jobs.create', compact('categories'));
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
            'name'              => 'required|string|min:4|max:191',
            'description'       => 'required|string|min:8',
            'category_id'       => 'required',
        ]);

        $job = Job::create([
            'name'          => $request['name'],
            'description'   => $request['description'],
            'category_id'   => $request['category_id'],
            'company_id'    => auth()->user()->id,
            'status'        => $request['status'],

        ]);

        return redirect('/company/jobs')->with('success', 'Jobs Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $job = Job::with('category')->find($id);
        return view('jobs.show', compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $job = Job::find($id);

        $categories = Category::all();
        return view('jobs.edit', compact('job', 'categories'));
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
            'description'   => 'required|string|min:8',
            'category_id'   => 'required|string',
        ]);

        // dd($request);
        $job = Job::findOrFail($id);
        $job->update($request->all());
        return redirect('/company/jobs')->with('success', 'Jobs Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $job =  Job::findOrFail($id);
        $job->delete();
        return redirect('/company/jobs')->with('success', 'job deleted successfully');
    }

    public function view_all()
    {
        $categories = [];
        UserSucceedCourse::where('user_id', Auth::user()->id)->with(['categories' => function ($query) use (&$categories) {
            $categories = $query->get()->pluck('id')->toArray();
        }])->get()->toArray();
        $jobs = Job::whereIn('category_id', $categories)->where('status', 1)->with(['category', 'company', 'userApplication' => function($query) {
            $query->where('user_id', Auth::user()->id);
        }])->withCount('userApplication')->get()->toArray();
        return view('jobs.user-view', compact('jobs'));
    }

    public function apply($job_id)
    {
        $user = User::find(Auth::user()->id);
        if (!$user->jobApplication->contains($job_id)) {
            $user->jobApplication()->attach($job_id, ['status' => 'Applied']);
            return redirect()->back()->with('success', 'Your application has been submitted successfully.');
        } else {
            return redirect()->back()->with('error', 'You have already applied on this job');
        }
    }

    public function applied_jobs() {
        $user = User::find(Auth::user()->id);
        $jobs = $user->jobApplication()->with('category')->get()->toArray();
        
        return view('user.applied-jobs', compact('jobs'));
    }

    public function job_applications() {
        $user = User::find(Auth::user()->id);
        $applications = Job::with(['category','userApplication'])->get()->toArray();
        return view("Company.job-applications", compact('applications'));
    }

    public function hire($user_id, $job_id) {
        $company = User::find(Auth::user()->id);
        $company->users()->attach($user_id);
        $user = User::find($user_id);
        $user->jobApplication()->updateExistingPivot ($job_id, ['status' => 'Hired']);
        return redirect()->back()->with('success', 'Applicant hired successfully');
    } 

    public function reject($user_id, $job_id) {
        $user = User::find($user_id);
        $user->jobApplication()->updateExistingPivot ($job_id, ['status' => 'Rejected']);
        return redirect()->back()->with('success', 'Applicant rejected');
    } 
}
