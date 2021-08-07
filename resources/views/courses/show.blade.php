@extends('layouts.master')
@push('links')
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.css') }}">
@endpush
@section('content')
    <!-- Content Header (Page header) -->
    <div class="container-fluid">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">All Courses</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Courses</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <div class="card">
            <div class="card-header">
                <h3>{{ $course['name'] }}</h3>
            </div>
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-md-8">
                        <div class="embed-responsive embed-responsive-16by9">
                            <video id="active-video" class="embed-responsive-item" width="320" height="240"
                                controls="controls" controlsList="nodownload">
                                <source src="{{ asset($course['lectures'][0]['video_path'] ?? '') }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                        <div class="p-2 h4">{{ $course['summary'] }}</div>
                        <div class="p-2">{!! $course['description'] !!}</div>
                        <div class="p-2">
                            <h3>Comments</h3>
                            <div class="card-footer card-comments">
                            </div>
                            <form id="submitCommentForm">
                                @csrf
                                <input type="hidden" name="lecture_id" value="{{ $course['lectures'][0]['video_path']??"" }}">
                                <div class="form-group">
                                    <label for="email" class="col-md-12 control-label">Leave a comment</label>
                                    <div class="col-md-12">
                                        <textarea class="form-control" name="comment" rows="3"></textarea>
                                        <p class="text-danger"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-md-12">
                                        <button class="btn btn-success btn-circle text-uppercase" type="submit"><span
                                                class="glyphicon glyphicon-send"></span> Summit
                                            comment</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h4 class="p-2 font-weight-bold">Course Content</h4>
                        <div class="list-group list-group-flush course-content">
                            @foreach ($course['lectures'] as $key => $lecture)
                                <a href="javascript:void(0)" class="list-group-item list-group-item-action"
                                    data-click="switch-video" data-id="{{ $lecture['id'] }}">{{ ++$key }}.
                                    {{ $lecture['video_title'] }}</a>
                            @endforeach
                        </div>
                        <h4 class="p-2 font-weight-bold">Course Quizzes</h4>
                        <div class="list-group list-group-flush">
                            @forelse($course['quizzes'] as $key => $quiz)
                                <a href="{{ route('test', $quiz['id']) }}"
                                    class="list-group-item list-group-item-action">{{ ++$key }}.
                                    {{ $quiz['title'] }}</a>
                            @empty
                                <p class="list-group-item">There are no quiz available in this course</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @push('scripts')
        <script>
            $(".course-content > a:first-child").addClass("list-group-item-primary");
            $("[data-click='switch-video']").click(function() {
                let lecture_id = $(this).data('id');
                let active_link = $(this);
                $.get("{{ url('admin/get-video-url') }}/" + lecture_id, function(response) {
                    try {
                        json_response = JSON.parse(response);
                        if (json_response) {
                            $("#submitCommentForm [name='lecture_id']").val(lecture_id);
                            $(".list-group a").removeClass("list-group-item-primary");
                            active_link.addClass("list-group-item-primary");
                            $("#active-video source").attr("src", "{{ asset('') }}" + json_response
                                .video_path);
                            $("#active-video")[0].load();
                            reload_comments(lecture_id);
                        }
                    } catch (e) {
                        Swal.fire(
                            'Error!',
                            "Err! Failed to submit test please try again",
                            'error'
                        )
                    }
                });
            });

            function reload_comments(lecture_id) {
                $.get("{{ route('user.get-comments') }}", {
                    lecture_id: lecture_id
                }, function(response) {
                    $(".card-comments").html(response);
                });
            }
            reload_comments("{{ $course['lectures'][0]['id'] ?? 0 }}");

            $("#submitCommentForm").submit(function(e) {
                e.preventDefault();
                let form = $(this);
                let formData = form.serializeArray();
                let lecture_id = $("#submitCommentForm [name='lecture_id']").val();
                $.ajax({
                    url: "{{ route('user.add-comment') }}",
                    type: "POST",
                    data: formData,
                }).done(function(response, textStatus, jqXHR) {
                    try {
                        console.log(response);
                        let json_response = JSON.parse(response);
                        if (json_response.errors) {
                            let errors = json_response.errors;
                            if (errors.comment) {
                                $("#submitCommentForm [name='comment']").addClass('is-invalid');
                                $("#submitCommentForm [name='comment']").next('p').text(errors.comment);
                            }
                        }
                        if (json_response.success) {
                            $("#submitCommentForm")[0].reset();
                            $("#submitCommentForm input").removeClass('is-invalid');
                            $("#submitCommentForm").find("p").text("");
                            Swal.fire(
                                'Success!',
                                json_response.success,
                                'success'
                            )
                            reload_comments(lecture_id);
                        }
                    } catch (e) {
                        Swal.fire(
                            'Error!',
                            "Err! Failed to post comment",
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
            })
        </script>
    @endpush
