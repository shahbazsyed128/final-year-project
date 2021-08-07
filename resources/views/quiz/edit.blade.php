@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Quiz</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('quiz') }}">Quiz</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="container">
            <div class="card card-primary p-4">

                <form action="{{ route('quiz.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $quiz['id'] }}">
                    <div class="row">
                        <div class="col-md-6">
                            <h4><i class="fa fa-info"></i> Quiz Details</h4>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="{{ route('questions', $quiz['id']) }}" class="btn btn-primary btn-sm"> Questions</a>
                            <a class="btn btn-success btn-sm" href="{{ route('quiz.view', $quiz['id']) }}"
                                title="View Quiz"><i class="fa fa-eye"></i></a>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label" for="inputName"><i class="fas fa-book"></i> Title</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-book"></i></span>
                                    </div>
                                    <input type="text" name="title" placeholder="Quiz Title" class="form-control"
                                        value="{{ $quiz['title'] }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label" for="inputEmail"><i class="fas fa-book"></i> Total
                                    Questions</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-book"></i></span>
                                    </div>
                                    <input type="text" name="total_questions" placeholder="Number of questions"
                                        value="{{ $quiz['total_questions'] }}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label" for="inputEmail"><i class="fas fa-book"></i> Number of
                                    options</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-book"></i></span>
                                    </div>
                                    <input type="text" name="number_of_options" placeholder="Number of options/question"
                                        value="{{ $quiz['number_of_options'] }}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label" for="inputEmail"><i class="fa fa-clock"></i> Duration in
                                    minutes</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-clock"></i></span>
                                    </div>
                                    <input type="text" name="duration" placeholder="Quiz duration in minutes"
                                        value="{{ $quiz['duration'] }}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label" for="inputEmail"><i class="fas fa-book-open"></i> Select
                                    Course</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-book-open"></i></span>
                                    </div>
                                    <select class="form-control" name="course_id" id="course">
                                        @foreach ($courses as $course)
                                            <option value="{{ $course['id'] }}"
                                                {{ $quiz['course_id'] == $course['id'] ? 'selected' : '' }}>
                                                {{ $course['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h4 class="mt-4"><i class="fa fa-certificate" aria-hidden="true"></i> Marking and Grading</h4>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label" for="inputEmail"><i class="fas fa-book"></i> Mark on each
                                    correct question</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-book"></i></span>
                                    </div>
                                    <input type="number" name="correct_mark" placeholder="Mark on each correct question"
                                        value="{{ $quiz['correct_mark'] }}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label" for="inputEmail"><i class="fas fa-book"></i> Mark on each
                                    incorrect question</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-book"></i></span>
                                    </div>
                                    <input type="number" name="incorrect_mark" placeholder="Mark on each incorrect question"
                                        value="{{ $quiz['incorrect_mark'] }}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label" for="inputEmail"><i class="fas fa-book"></i> Passing
                                    Criteria (Percentage)</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-book"></i></span>
                                    </div>
                                    <input type="number" name="passing_marks" placeholder="Enter passing percentage i.e 60"
                                        value="{{ $quiz['passing_marks'] }}" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label">Status</label>
                                <select name="status_id" id="status" class="form-control">
                                    <option value="0" {{ $course['id'] }}" {{ old('status') == 0 ? 'selected' : '' }}>
                                        Inactive</option>

                                    <option value="1" {{ $quiz['status']['id'] == 1 ? 'selected' : '' }}>Active</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6"></div>
                        <div class="col-sm-6">
                            <div class="float-right mt-4">
                                <button type="submit" class="btn btn-info"> <i class="fa fa-save"></i> Save Changes</button>
                                <input type="reset" class="btn btn-danger" value="Cancel">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"
        integrity="sha512-YUkaLm+KJ5lQXDBdqBqk7EVhJAdxRnVdT2vtCzwPHSweCzyMgYV/tgGF4/dCyqtCC2eCphz0lRQgatGVdfR0ww=="
        crossorigin="anonymous"></script>

@endpush
