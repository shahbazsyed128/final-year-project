<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Quiz;
use App\Question;
use App\Option;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create($quiz_id)
    {
        $quiz = Quiz::with('course', 'status', 'questions')->where('id', $quiz_id)->get()->first()->toArray();

        return view('quiz.questions', compact('quiz'));
    }

    public function store(Request $request)
    {
        $rules = [
            'question' => 'required',
            'answer' => 'required',
            'options.*' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules, [
            'options.*.required' => 'Required'
        ]);
        if ($validator->fails()) {

            $data['errors'] = $validator->errors()->toArray();
        } else {
            $quiz = Quiz::find($request->quiz_id);
            if ($quiz->questions()->count() < $quiz->total_questions) {
                $question = Question::create(['quiz_id' => $request->quiz_id, 'question' => $request->question, 'answer' => $request->answer]);
                if ($question->id) {
                    foreach ($request->options as $option) {
                        option::create(['question_id' => $question->id, 'option' => $option]);
                    }
                    $data['success'] = "Question saved successfully";
                }
            } else {
                $data['errors']['total_questions'] = "Questions limit reached";
            }
        }
        echo json_encode($data);
    }

    public function update(Request $request)
    {
        $rules = [
            'question' => 'required',
            'answer' => 'required',
            'options.*' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules, [
            'options.*.required' => 'Required'
        ]);
        if ($validator->fails()) {

            $data['errors'] = $validator->errors()->toArray();
        } else {
            $question = Question::find($request->question_id);
            $question->question = $request->question;
            $question->answer = $request->answer;

            if ($question->save()) {
                foreach ($request->options as $key => $option) {
                    $op = Option::find($key);
                    if($op) {
                        $op->option = $option;
                        $op->save();
                    } else {
                        $option = Option::create([
                            'question_id' => $request->question_id,
                            'option' => $option
                        ]);
                    }
                }
                $data['success'] = "Question saved successfully";
            }
        }
        echo json_encode($data);
    }

    public function get_all_by_quiz_id($quiz_id)
    {
        $quiz = Quiz::find($quiz_id);
        $data['questions'] = $quiz->questions()->get()->toArray();
        $data['questionsCount'] = $quiz->questions()->count();
        echo json_encode($data);
    }

    public function get_single_by_id($question_id)
    {
        $data['question'] = Question::where('id', $question_id)->with('options')->first()->toArray();

        echo json_encode($data);
    }

    public function destroy($id)
    {
        $question = Question::find($id);
        $question->options()->delete();
        $question->delete();
        $data['success'] = "Question deleted successfully";
        echo json_encode($data);
    }
}
