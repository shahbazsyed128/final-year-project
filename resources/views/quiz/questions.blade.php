@extends('layouts.master')

@push('links')
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.css') }}">
@endpush
@section('content')
    <div class="container-fluid">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Add Questions</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Add Questions</li>
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
                <div class="card-header bg-transparent text-dark">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Quiz Details</h5>
                        </div>
                        <div class="col-md-6 text-right">
                            <a class="btn btn-success btn-sm" href="{{route("quiz.view", $quiz['id'])}}" title="View Quiz"><i class="fa fa-eye"></i></a>
                            <a class="btn btn-primary btn-sm" href="{{route("quiz.edit", $quiz['id'])}}" title="Edit Quiz"><i class="fa fa-edit"></i></a>
                        </div>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-form-label"><i class="fas fa-book"></i> Title</label>
                            <div class="color-palette-set">
                                <div class="bg-lightblue color-palette"><span>{{ $quiz['title'] }}</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-form-label"><i class="fa fa-question-circle" aria-hidden="true"></i> Total
                                Questions</label>
                            <div class="color-palette-set">
                                <div class="bg-lightblue color-palette"><span>{{ $quiz['total_questions'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-form-label"><i class="fa fa-check-circle" aria-hidden="true"></i> Number
                                of options</label>
                            <div class="color-palette-set">
                                <div class="bg-lightblue color-palette"><span>{{ $quiz['number_of_options'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-form-label"><i class="fa fa-clock"></i> Duration in minutes</label>
                            <div class="color-palette-set">
                                <div class="bg-lightblue color-palette"><span>{{ $quiz['duration'] }}</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-form-label"><i class="fas fa-book-open"></i> Course</label>
                            <div class="color-palette-set">
                                <div class="bg-lightblue color-palette"><span>{{ $quiz['course']['name'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-form-label"><i class="fas fa-info-circle"></i> Status</label>
                            <div class="color-palette-set">
                                <div class="{{ $quiz['status_id'] == 1 ? 'bg-success' : 'bg-danger' }} color-palette">
                                    <span>{{ $quiz['status']['title'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="card">
                    <form id="create_question">
                        @csrf
                        <input type="hidden" name="quiz_id" value="{{ $quiz['id'] }}">
                        <div class="card-header bg-secondary">
                            <h4 id="card-title">Add Question</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Question</label>
                                        <input type="text" class="form-control" name="question"
                                            placeholder="Enter Question">
                                        <p class="text-danger"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @for ($i = 1; $i <= $quiz['number_of_options']; $i++)
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ chr($i + 64) }}</label>
                                            <input type="text" class="form-control" name="options[{{ chr($i + 64) }}]"
                                                placeholder="Enter option {{ chr($i + 64) }}">
                                            <p class="text-danger"></p>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Answer</label>
                                    <select name="answer" class="form-control">
                                        @for ($i = 1; $i <= $quiz['number_of_options']; $i++)
                                            <option value="{{ chr($i + 64) }}">{{ chr($i + 64) }}</option>
                                        @endfor
                                    </select>
                                    <p class="text-danger"></p>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-info">Save</button>
                        </div>
                    </form>
                    <form id="update_question" class="d-none">
                        @csrf
                        <input type="hidden" name="question_id" value="">
                        <div class="card-header bg-secondary">
                            <h4 id="card-title">Update Question</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Question</label>
                                        <input type="text" class="form-control" name="question"
                                            placeholder="Enter Question">
                                        <p class="text-danger"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @for ($i = 1; $i <= $quiz['number_of_options']; $i++)
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ chr($i + 64) }}</label>
                                            <input type="text" class="form-control" name="options[{{ chr($i + 64) }}]"
                                                placeholder="Enter option {{ chr($i + 64) }}">
                                            <p class="text-danger"></p>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Answer</label>
                                    <select name="answer" class="form-control">
                                        @for ($i = 1; $i <= $quiz['number_of_options']; $i++)
                                            <option value="{{ chr($i + 64) }}">{{ chr($i + 64) }}</option>
                                        @endfor
                                    </select>
                                    <p class="text-danger"></p>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-info">Update</button>
                            <button class="btn btn-danger" id="cancel-update">Cancel</button>
                        </div>
                    </form>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header bg-secondary ">
                                <div class="row">
                                    <div class="col-md-6">Questions</div>
                                    <div class="col-md-6 text-right" id="totalQuestionCount"></div>
                                </div>
                            </div>
                            <div class="card-body" id="questions"></div>
                        </div>
                    </div>
                </div>
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
    <!-- Summernote -->
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>

    <script>
        $(function() {
            // Summernote
            $('textarea').summernote()
        })

        function reload_questions() {
            $.get("{{ route('questions.get', $quiz['id']) }}", function(response) {
                try {
                    json_response = JSON.parse(response);
                    if (json_response.questions) {
                        $("#questions").empty();
                        $("#totalQuestionCount").text(json_response.questionsCount + "/" +
                            "{{ $quiz['total_questions'] }}");
                        $.each(json_response.questions, function(index, question) {
                            $("#questions").append(
                                "<div class='card-title d-flex justify-content-between' id='question_" +
                                question['id'] + "'><h5>Q. " + (++
                                    index) + " - " + question[
                                    'question'] +
                                "</h5><div><a class='text-danger btn-sm delete' href='javascript:void(0)' data-id='" +
                                question['id'] +
                                "' title='Delete'><i class='fa fa-trash'></i></a><a class='btn-sm edit' href='javascript:void(0)' data-id='" +
                                question['id'] +
                                "' title='Edit'><i class='fa fa-edit'></i></a></div></div><div id='options_" +
                                question['id'] +
                                "'></div><p class='card-text font-weight-bold mt-4'><span class='text-teal' style='font-size:16px'>Answer:</span> Option " +
                                question['answer'] + "</p><hr>");
                            $.each(question.options, function(i, option) {
                                $("#options_" + question['id']).append("<p class='card-text'>" +
                                    String.fromCharCode(i + 65) + "). " + option['option'] +
                                    "</p>");
                            });
                        });

                        if(!json_response.questions.length) {
                            $("#questions").html("<p>There is no question available in this quiz! please add questions.</p>");
                        }
                    }
                } catch (e) {
                    alert('An error occured');
                };
            });
        }
        reload_questions();

        $("#create_question").submit(function(event) {
            event.preventDefault();
            let form = $(this);
            let formData = form.serialize();
            $.ajax({
                url: "{{ route('question.store') }}",
                type: "POST",
                data: formData
            }).done(function(response, textStatus, jqXHR) {
                json_response = JSON.parse(response);
                if (json_response.errors) {
                    validation_errors("#create_question", json_response.errors);
                } else if (json_response.success) {
                    remove_errors();
                    reload_questions();
                    Swal.fire(
                        'Success!',
                        'Record has been saved.',
                        'success'
                    );
                    $("#create_question")[0].reset();
                }
            }).fail(function(jqXHR, textStatus, errorThrown) {
                Swal.fire(
                    'Error!',
                    "An error occured",
                    'error'
                )
            });
        });

        function validation_errors(form, errors) {
            remove_errors();
            if (errors.question) {
                $(form + " [name='question'").addClass('is-invalid');
                $(form + " [name='question']").next('p').text(errors.question);
            }
            if (errors.answer) {
                $(form + " [name='answer'").addClass('is-invalid');
                $(form + " [name='answer']").next('p').text(errors.answer);
            }

            if (errors.total_questions) {
                Swal.fire(
                    'Info!',
                    errors.total_questions,
                    'info'
                );
            }

            $.each(errors, function(index, value) {
                if (index.includes('options')) {
                    let option = index.substring(index.indexOf('.') + 1);
                    $(form + " [name='options[" + option + "]']").addClass('is-invalid');
                    $(form + " [name='options[" + option + "]']").next('p').text(value);
                }
            });
        }

        function remove_errors() {
            $("input").removeClass('is-invalid');
            $("#create_question p").text('');
        }

        $(document).on("click", ".delete", function(e) {
            let question_id = $(this).data('id');
            $.get("{{ url('question/destroy') }}/" + question_id, function(response) {
                try {
                    let json_reponse = JSON.parse(response);
                    if (json_reponse.success) {
                        reload_questions();
                        Swal.fire(
                            'Success!',
                            json_reponse.success,
                            'success'
                        );
                    }
                } catch (e) {
                    Swal.fire(
                        'Error!',
                        e,
                        'error'
                    );
                }
            });
        });

        $(document).on("click", ".edit", function(e) {
            let question_id = $(this).data('id');
            $.get("{{ url('question/get') }}/" + question_id, function(response) {
                try {
                    let json_response = JSON.parse(response);
                    if (json_response.question) {
                        $.each($("#update_question [name^='options']"), function(index, value) {
                            $(value).attr('name', 'options[' + String.fromCharCode(index + 65) +
                                ']');
                        });

                        let question = json_response.question;
                        $("#update_question")[0].reset();
                        $("#create_question").addClass('d-none');
                        $("#update_question").removeClass('d-none');
                        $("#update_question [name='question_id']").val(question.id);
                        $("#update_question [name='question']").val(question.question);
                        $("#update_question [name='answer']").val(question.answer);

                        $.each(question.options, function(index, value) {
                            $("#update_question [name='options[" + String.fromCharCode(index + 65) +
                                "]']").val(value.option);
                            $("#update_question [name='options[" + String.fromCharCode(index + 65) +
                                "]']").attr('name', 'options[' + value['id'] + ']');
                        });
                        document.getElementById('update_question').scrollIntoView();
                    }
                } catch (e) {
                    Swal.fire(
                        'Error!',
                        e,
                        'error'
                    );
                }
            });
        });

        $("#update_question").submit(function(e) {
            e.preventDefault();
            let form = $(this);
            let formData = form.serialize();
            $.ajax({
                url: "{{ route('question.update') }}",
                type: "POST",
                data: formData
            }).done(function(response, textStatus, jqXHR) {
                json_response = JSON.parse(response);
                if (json_response.errors) {
                    validation_errors("#update_question", json_response.errors);
                } else if (json_response.success) {
                    remove_errors();
                    reload_questions();
                    reset_forms();
                    Swal.fire(
                        'Success!',
                        json_response.success,
                        'success'
                    );
                    let question_id = $("#update_question [name='question_id']").val();
                    document.getElementById('question_' + question_id).scrollIntoView();
                }
            }).fail(function(jqXHR, textStatus, errorThrown) {
                Swal.fire(
                    'Error!',
                    "An error occured",
                    'error'
                )
            });
        });

        function reset_forms() {
            $("#update_question")[0].reset();
            $("#update_question").addClass('d-none');
            $("#create_question").removeClass('d-none');
            remove_errors();
        }

        $("#cancel-update").click(function(e) {
            e.preventDefault();
            reset_forms();
        });

    </script>
@endpush
