<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quiz;
use App\Course;
use App\Option;
use App\Question;
use App\User;
use App\UserQuizAttempt;
use App\UserQuizQuestion;
use App\UserSucceedCourse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $quizzes = Quiz::where('author_id', Auth::user()->id)->with(['course', 'status'])->orderBy('id', 'DESC')->get()->toArray();
        return view('quiz.index', compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = Course::where('author_id', Auth::user()->id)->orderBy('id', 'DESC')->get()->toArray();
        return view('quiz.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'total_questions' => 'required|numeric',
            'number_of_options' => 'required|numeric|max:6',
            'duration' => 'required|numeric',
            'course_id' => 'required|exists:courses,id',
            'correct_mark' => 'required|numeric',
            'incorrect_mark' => 'required|numeric',
            'passing_marks' => 'required|numeric',
        ], [
            "course_id.required" => "The Course field is required",
            "course_id.exists" => "This Course does not exist",
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $quiz = Quiz::create(array_merge($request->all(),  ['author_id' => Auth::user()->id]));
            return redirect()->route('questions', $quiz->id)->with('success', "Quiz saved successfully! create questons for this quiz");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $quiz = Quiz::with(['course', 'status', 'questions'])->where('id', $id)->first()->toArray();

        return view('quiz.view', compact('quiz'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $quiz = Quiz::with(['course', 'status', 'questions'])->where('id', $id)->first()->toArray();
        $courses = Course::orderBy('id', 'DESC')->get()->toArray();
        return view('quiz.edit', compact(['quiz', 'courses']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'total_questions' => 'required|numeric',
            'number_of_options' => 'required|numeric|max:6',
            'duration' => 'required|numeric',
            'course_id' => 'required|exists:courses,id',
            'correct_mark' => 'required|numeric',
            'incorrect_mark' => 'required|numeric',
            'passing_marks' => 'required|numeric',
            'status_id' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $quiz = Quiz::find($request->id);
            if ($request->status_id == 1) {
                if ($quiz->questions()->count() < $request->total_questions) {
                    return redirect()->back()->withErrors(['questions' => "This quiz can not be active! please complete all questions."]);
                }
            }

            $questionsExcept = $quiz->questions()->take($request->total_questions)->pluck('id');
            $questions = Question::whereNotIn('id', $questionsExcept);
            $questions->delete();
            $totalOptions = $request->number_of_options;
            $quiz->questions()->each(function ($row) use ($totalOptions) {
                $except = $row->options()->take($totalOptions)->pluck('id')->toArray();
                Option::where('question_id', $row->id)
                    ->whereNotIn('id', $except)->delete();
            });
            $quiz->update($request->except(['id', '_token']));
            return redirect()->back()->with('success', "Quiz updated successfully");
        }
    }

    public function test($id)
    {
        $quiz = Quiz::where('id', $id)->with('questions')->first()->toArray();
        return view("student.test", compact('quiz'));
    }

    public function submitQuiz(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "quiz_id" => "required"
        ]);
        if ($validator->fails()) {
            $data['errors'] = $validator->errors()->toArray();
        } else {

            $QuizAttempt = UserQuizAttempt::firstOrCreate(
                [
                    'user_id' => Auth::user()->id,
                    'quiz_id' => $request->quiz_id
                ]
            );
            if ($QuizAttempt->id) {
                UserQuizQuestion::where('attemptId', $QuizAttempt->id)->delete();
                if (isset($request->option)) {
                    foreach ($request->option as $question => $answer) {
                        $QuizQuestion = new UserQuizQuestion();
                        $QuizQuestion->attemptId = $QuizAttempt->id;
                        $QuizQuestion->question_id = $question;
                        $QuizQuestion->answer = $answer;
                        $QuizQuestion->save();
                    }
                }
                $results = Auth::user()->AttemptedQuiz()->with(['quiz', 'QuizQuestions.Question'])->withCount('QuizQuestions')->first()->toArray();
                $correctAnswers = 0;
                $incAnswers = 0;
                foreach ($results['quiz_questions'] as $question) {
                    if ($question['answer'] === $question['question']['answer']) {
                        $correctAnswers++;
                    } else {
                        $incAnswers++;
                    }
                }
                $obMarks = ($correctAnswers * $results['quiz']['correct_mark']) - ($incAnswers * $results['quiz']['incorrect_mark']);
                $perc = ($obMarks / $results['quiz']['total_questions']) * 100;
                $data['results']['total_questions'] = $results['quiz']['total_questions'];
                $data['results']['answeredQuestions'] = $results['quiz_questions_count'];
                $data['results']['unAnsweredQuestions'] = $results['quiz']['total_questions'] - $results['quiz_questions_count'];
                $data['results']['correctAnswers'] = $correctAnswers;
                $data['results']['incAnswers'] = $incAnswers;
                $data['results']['obMarks'] = $obMarks;
                $attempts = $QuizAttempt->attempts;
                $score = $QuizAttempt->score;
                if ($perc > $score) {
                    $QuizAttempt->score = $perc;
                }
                $QuizAttempt->attempts = ($attempts ?? 0) + 1;
                $QuizAttempt->save();

                $user = User::where('id', Auth::user()->id)->with(['registeredCourses.quizzes.userAttempt'])->first(['id'])->toArray();
                $userCanStartCourse = true;
                foreach ($user['registered_courses'] as $course) {
                    foreach ($course['quizzes'] as $quiz) {
                        if (!empty($quiz['user_attempt']) && ($quiz['user_attempt'][0]['score'] < $quiz['passing_marks'])) {
                            $userCanStartCourse = false;
                        } else if (empty($quiz['user_attempt'])) {
                            $userCanStartCourse = false;
                        }
                    }
                    if ($userCanStartCourse) {
                        UserSucceedCourse::create([
                            'user_id' => Auth::user()->id,
                            'course_id' => $course['id']
                        ]);
                    }
                }
            } else {
                $data['error'] = "Err! Failed to submit Test please attempt again";
            }
        }
        echo json_encode($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $quiz = Quiz::find($id);
        if ($quiz->options()) {
            $quiz->options()->delete();
        }
        if ($quiz->questions()) {
            $quiz->questions()->delete();
        }
        $quiz->delete();
        if ($quiz) {
            return redirect()->route('quiz')->with('success', "Quiz deleted successfully");
        } else {
            return redirect()->route('quiz')->with('error', "Failed to delete quiz");
        }
    }
}
