@extends('layouts.master')
@section('content')
<div class="container-fluid">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">View Quiz</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('quiz')}}">Quiz</a></li>
                        <li class="breadcrumb-item active">View</li>
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
            <div class="row">
                <div class="col-md-6">
                    <h4><i class="fa fa-info"></i> View Details</h4>
                </div>
                <div class="col-md-6 text-right">
                    <a href="{{route('questions', $quiz['id'])}}" class="btn btn-info btn-sm"> Questions</a>
                    <a class="btn btn-primary btn-sm" href="{{route("quiz.edit", $quiz['id'])}}" title="Edit Quiz"><i class="fa fa-edit"></i></a>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label"><i class="fas fa-book"></i> Title</label>
                        <div class="color-palette-set">
                            <div class="bg-lightblue color-palette"><span>{{$quiz['title']}}</span></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label"><i class="fa fa-question-circle" aria-hidden="true"></i> Total Questions</label>
                        <div class="color-palette-set">
                            <div class="bg-lightblue color-palette"><span>{{$quiz['total_questions']}}</span></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label"><i class="fa fa-check-circle" aria-hidden="true"></i> Number of options</label>
                        <div class="color-palette-set">
                            <div class="bg-lightblue color-palette"><span>{{$quiz['number_of_options']}}</span></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label"><i class="fa fa-clock"></i> Duration in minutes</label>
                        <div class="color-palette-set">
                            <div class="bg-lightblue color-palette"><span>{{$quiz['duration']}}</span></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label"><i class="fas fa-book-open"></i> Course</label>
                        <div class="color-palette-set">
                            <div class="bg-lightblue color-palette"><span>{{$quiz['course']['name']}}</span></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label"><i class="fas fa-info-circle"></i> Status</label>
                        <div class="color-palette-set">
                            <div class="{{($quiz['status_id'] == 1)?'bg-success':'bg-danger'}} color-palette"><span>{{$quiz['status']['title']}}</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-secondary">
                            Questions
                        </div>
                        <div class="card-body">

                            @forelse($quiz['questions'] as $key => $question)
                            <h5 class="card-title">Q.{{++$key}} - {{$question['question']}}</h5>

                            @foreach($question['options'] as $i => $option)
                            <p class="card-text">{{chr($i+65)}}). {{$option['option']}}</p>
                            @endforeach
                            <p class="card-text font-weight-bold"><span class="text-teal" style="font-size:16px">Answer:</span> Option {{$question['answer']}}</p>
                            <hr>
                            @empty
                            <p>There is no question available in this quiz! please add <a href='{{route('questions', $quiz['id'])}}'>questions</a>.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha512-YUkaLm+KJ5lQXDBdqBqk7EVhJAdxRnVdT2vtCzwPHSweCzyMgYV/tgGF4/dCyqtCC2eCphz0lRQgatGVdfR0ww==" crossorigin="anonymous"></script>
@endpush