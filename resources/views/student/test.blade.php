@extends('layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="container-fluid">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Quiz</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Quiz</li>
                            <li class="breadcrumb-item active">Test</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <div class="card">
            <div class="card-header row">
                <div class="col-md-6">
                    <h3>{{ $quiz['title'] }}</h3>
                </div>
                <div class="col-md-6 text-right">
                    <a href="{{ route('user.view-course', $quiz['course_id'])}}" class="">Back to Course</a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="container" id="instructions">
                    <div class="jumbotron jumbotron-fluid">
                        <div class="container">
                            <h1 class="display-4">{{ $quiz['title'] }}</h1>
                            <div class="div-test-instruction">
                                <h6 class="text-danger font-weight-bold mx-uline">Instructions:</h6>
                                <ul class="ul-test-instruction">
                                    <li>Total number of questions : <b>{{ $quiz['total_questions'] }}</b>.</li>
                                    <li>Time alloted : <b>{{ $quiz['duration'] }}</b> minutes.</li>
                                    @if (!$quiz['incorrect_mark'])
                                        <li>Each question carry {{ $quiz['correct_mark'] }} mark, no negative marks.</li>
                                    @else
                                        <li>Each question carry {{ $quiz['correct_mark'] }} mark.</li>
                                        <li>Negative marking: -{{ $quiz['incorrect_mark'] }} mark.</li>
                                    @endif
                                    <li>In order to pass the test you have to get atleast
                                        <b>{{ $quiz['passing_marks'] }}%</b>
                                    </li>
                                    <li>DO NOT refresh the page.</li>
                                    <li>All the best :-).</li>
                                </ul>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-primary" id="startTest">Start Test</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container question-container d-none" id="quiz">
                    <div class="card-header text-right text-danger" id="quiz-header">Time Left: <span
                            class="countdown">{{ $quiz['duration'] }}</span></div>
                    <form id="quizSubmit" action="{{ route('user.submit_quiz') }}" method="POST">
                        @csrf
                        <input type="hidden" name="quiz_id" value="{{ $quiz['id'] }}">
                        @foreach ($quiz['questions'] as $key => $question)
                            <div class="question ml-sm-5 pl-sm-5 pt-2" id="questionBox">
                                <div class="py-2 h5">
                                    <b>{{ 'Q.' . ++$key }} &nbsp; {{ $question['question'] }}</b>
                                </div>
                                <div class="" id="options">
                                    <ul class="list-unstyled">
                                        @foreach ($question['options'] as $i => $option)
                                            <li>
                                                <label class="options">{{ $option['option'] }}
                                                    <input type="radio" name="option[{{ $question['id'] }}]"
                                                        value="{{ chr($i + 65) }}">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                        <div class="card-footer">
                            <div class="text-center">
                                <button class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="container question-container d-none" id="results">
                    <div class="card-header">Test Results</div>
                    <table cellspacing="0" cellpadding="4"
                        style="font-size:12px; border:2px solid #ddf8c2; background-color:#fafafa;" width="100%">
                        <tbody>
                            <tr>
                                <td class="text-center font-weight-bold" bgcolor="#ddf8c2" colspan="3" id="obMarks">Marks :
                                    0/20 </td>
                            </tr>
                            <tr>
                                <td>Total number of questions</td>
                                <td width="1%">:</td>
                                <td width="10%" class="text-right font-weight-bold">{{ $quiz['total_questions'] }}</td>
                            </tr>
                            <tr>
                                <td>Number of answered questions</td>
                                <td width="1%">:</td>
                                <td class="font-weight-bold text-right" id="answeredQuestions"></td>
                            </tr>
                            <tr>
                                <td>Number of unanswered questions</td>
                                <td width="1%">:</td>
                                <td class="font-weight-bold text-right" id="unAnsweredQuestions"></td>
                            </tr>
                            <tr>
                                <td>Correct answers</td>
                                <td width="1%">:</td>
                                <td class="font-weight-bold text-right" id="correctAnswers"></td>
                            </tr>
                            <tr>
                                <td>Incorrect answers</td>
                                <td width="1%">:</td>
                                <td class="font-weight-bold text-right" id="incAnswers"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection
    @push('scripts')
        <script>
            let current_question = null;
            $("#startTest").click(function() {
                countDown();
                $("#instructions").toggleClass('d-none');
                $("#quiz").toggleClass('d-none');
            });

            function countDown() {
                var timer2 = "{{ $quiz['duration'] }}:0";
                var interval = setInterval(function() {
                    var timer = timer2.split(':');
                    var minutes = parseInt(timer[0], 10);
                    var seconds = parseInt(timer[1], 10);
                    --seconds;
                    minutes = (seconds < 0) ? --minutes : minutes;
                    if (minutes < 0) {
                        $("#quizSubmit").submit();
                        clearInterval(interval)
                    };
                    seconds = (seconds < 0) ? 59 : seconds;
                    seconds = (seconds < 10) ? '0' + seconds : seconds;
                    $('.countdown').html(minutes + ':' + seconds);
                    timer2 = minutes + ':' + seconds;
                }, 1000);
            }

            $("#quizSubmit").submit(function(e) {
                e.preventDefault();
                let form = document.getElementById('quizSubmit');
                let formData = new FormData(form);
                $.ajax({
                    url: "{{ route('user.submit_quiz') }}",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false
                }).done(function(response, textStatus, jqXHR) {
                    try {
                        json_response = JSON.parse(response);
                        if (json_response.results) {
                            let results = json_response.results;
                            $("#quiz").addClass("d-none");
                            $("#results").removeClass('d-none');
                            $("#obMarks").text("Marks : " + results['obMarks'] +
                                " / {{ $quiz['total_questions'] }}");
                            $("#answeredQuestions").text(results['answeredQuestions']);
                            $("#unAnsweredQuestions").text(results['unAnsweredQuestions']);
                            $("#correctAnswers").text(results['correctAnswers']);
                            $("#incAnswers").text(results['incAnswers']);
                        } else if (json_response.error) {
                            Swal.fire(
                                'Error!',
                                json_response.error,
                                'error'
                            )
                        }
                    } catch (e) {
                        Swal.fire(
                            'Error!',
                            "An error occured",
                            'error'
                        )
                    }
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    Swal.fire(
                        'Error!',
                        "Err! Failed to submit test please try again",
                        'error'
                    )
                });
            });
        </script>
    @endpush
