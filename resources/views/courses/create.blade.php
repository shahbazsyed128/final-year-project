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
                        <h1 class="m-0">Add Course</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Add Course</li>
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

                <form action="{{ route('courses.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-form-label" for="inputName"><i class="fas fa-book"></i> Course
                                    Name</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-book"></i></span>
                                    </div>
                                    <input type="text" required name="name" placeholder="Course Name" class="form-control"
                                        value="{{ old('name') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-form-label" for="inputEmail"><i class="fas fa-book"></i> Course
                                    Type</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-book"></i></span>
                                    </div>
                                    @can('isAdmin')
                                        <select required name="category_id" placeholder="Course Category" class="form-control">
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    @endcan
                                    @can('isUser')
                                        <select required name="category_id" placeholder="Course Category" class="form-control">
                                            <option value="">Select Category</option>
                                            @foreach ($categories[0] as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    @endcan
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-form-label" for="inputEmail"><i class="fas fa-book"></i> Course
                                    Subject</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-book"></i></span>
                                    </div>
                                    <input type="text" required name="subject" placeholder="Course Subject"
                                        value="{{ old('subject') }}" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-form-label" for="description"><i class="fas fa-book"></i>
                                    Sumamry</label>
                                    <textarea class="form-control" name="summary" placeholder="Course Summary" rows="4">{{ old('summary') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-form-label" for="description"><i class="fas fa-book"></i>
                                    Description</label>
                                <textarea name="description" id="description" placeholder="Description" class="textarea"
                                    rows="4">{{ old('description') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="0" {{ old('status') === '0' ? 'selected' : '' }}>Inactive</option>
                                    <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Active</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="form-control-label">Price</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                    </div>
                                    <input type="number" required name="price" required placeholder="Course Price"
                                        value="{{ old('price') }}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="float-right mt-4">
                                <button class="btn btn-secondary addvideo" type="button"><i class="fa fa-video"></i> Add
                                    Videos</button>
                            </div>
                        </div>
                    </div>
                    <div class="" id="video-div">

                    </div>
                    <div class="row">
                        <div class="col-sm-6"></div>
                        <div class="col-sm-6">
                            <div class="float-right mt-4">
                                <button type="submit" class="btn btn-info"> <i class="fa fa-save"></i> Add Course</button>
                                <a class="btn btn-danger" href="/users"> Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>

                <form method="POST" action="{{ route('fileUploadPost') }}" class="form-upload " style="display:none"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="progress">
                                    <div class="bar"></div>
                                    <div class="progress-bar progress-bar-striped bg-success" role="progressbar"
                                        aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                        <div class="percent">0%</div>
                                    </div>
                                </div>
                                <br>
                                <input name="file" id="poster" type="file" accept=".mkv,.mp4" class="form-control"><br />
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <button type="submit" class="btn btn-success"><i class="fa fa-upload"></i>Upload</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"
        integrity="sha512-YUkaLm+KJ5lQXDBdqBqk7EVhJAdxRnVdT2vtCzwPHSweCzyMgYV/tgGF4/dCyqtCC2eCphz0lRQgatGVdfR0ww=="
        crossorigin="anonymous"></script>

    <!-- Summernote -->
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script type="text/javascript">
        $(function() {
            // Summernote
            $('.textarea').summernote({
                height: 150,
            });
        });
        //   $('.form-upload').hide();
        $('.addvideo').on('click', function() {
            $('.form-upload').show();
        });
        var path = "{{ asset('files') }}";
        var count = 0;

        function validate(formData, jqForm, options) {
            var form = jqForm[0];
            if (!form.file.value) {
                alert('File not found');
                return false;
            }
        }

        (function() {
            var bar = $('.progress-bar');
            var percent = $('.percent');
            var status = $('#statuss');

            $('.form-upload').ajaxForm({
                beforeSubmit: validate,
                beforeSend: function() {
                    $('.progress').show();
                    status.empty();
                    var percentVal = '0%';
                    var posterValue = $('input[name=file]').fieldValue();
                    bar.width(percentVal)
                    percent.html(percentVal);
                },
                uploadProgress: function(event, position, total, percentComplete) {
                    var percentVal = percentComplete + '%';
                    bar.width(percentVal);
                    bar.addClass('progress-bar-animated');
                    percent.html(percentVal);
                },
                success: function(response) {
                    var html = '';
                    var file = path + "/" + response.filename;
                    var file_path = 'files/' + response.filename;
                    html += '<div class="row" id="vid-div' + count +
                        '"><div class="col-sm-5"><video width="350" height="100">';
                    html += '<source src="' + file + '" type="video/mp4">';
                    html += '</video></div>';
                    html += '<div class="col-sm-6"><div class="form-group">';
                    html +=
                        '<label class="col-form-label" for="inputEmail"><i class="fas fa-book"></i> Course Type</label>';
                    html +=
                        '<div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-book"></i></span></div>';
                    html += '<input type="text" required name="video_title[' + count +
                        ']" placeholder="Video Title" value="" class="form-control">';
                    html += '<input type="hidden" name="video_path[' + count + ']" value="' + file_path +
                        '" ></div></div></div>';
                    html +=
                        '<div class="col-sm-1"><button class="bg-transparent  border-0" onclick="deletevideo(' +
                        count + ')"><i class="fa fa-trash text-danger mt-4"></i></button></div></div>';
                    $('#video-div').append(html);
                    var percentVal = 'Upload Complete';
                    bar.width(percentVal)
                    bar.removeClass('progress-bar-animated');
                    percent.html(percentVal);
                    count++;
                },
                complete: function(xhr) {
                    status.html(xhr.responseText);
                    $('#poster').val('');
                    alert('Uploaded Successfully');
                }

            });

        })();

        function deletevideo(row) {
            $('#vid-div' + row).remove();
        }
    </script>
@endpush
