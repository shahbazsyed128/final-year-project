<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::group(['middleware' => ['auth']], function () {
    Route::resource('users', UserController::class);
    Route::resource('courses', CourseController::class)->middleware("can:isMentor");
    Route::resource('categories', CategoryController::class)->middleware("can:isAdmin");

    Route::prefix('company')->middleware("can:isCompany")->group(function () {
        Route::get('user/view/{user_id}', [App\Http\Controllers\UserController::class, 'view_user'])->name('company.user.view');
        Route::get('employees', [App\Http\Controllers\UserController::class, 'employees'])->name('company.employees');
        Route::get('user/hire/{user_id}/{job_id}', [App\Http\Controllers\JobController::class, 'hire'])->name('company.user.hire');
        Route::get('user/reject/{user_id}/{job_id}', [App\Http\Controllers\JobController::class, 'reject'])->name('company.user.reject');
        Route::get('jobs/applications', [App\Http\Controllers\JobController::class, 'job_applications'])->name('company.jobs.applications');
        Route::resource('jobs', JobController::class);
        // Route::get('jobs', [App\Http\Controllers\JobController::class, "index"])->name("company.jobs");
    });

    Route::post('/add-comment', [App\Http\Controllers\LectureCommentController::class, "store"])->name("user.add-comment");
    Route::get('/get-comments', [App\Http\Controllers\LectureCommentController::class, "user_get_comments"])->name("user.get-comments");
});

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/home', 'HomeController@index')->name('home');

Route::post('/users/update/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');
Route::post('/updateuser/{id}', 'UserController@updateUserDetails')->name('userupdate');
Route::post('/courses/create', 'CourseController@fileUploadPost')->name('fileUploadPost');
Route::post('/courses/update/{id}', [App\Http\Controllers\CourseController::class, 'update'])->name('courses.update');


Route::prefix('admin')->middleware('can:isAdmin')->group(function () {
    Route::get('/get-video-url/{id}', [App\Http\Controllers\RegisteredCoursesController::class, "get_video_url"])->name("user.get-video-url");
});

Route::middleware('can:isAdmin')->group(function () {
    Route::get('/users', 'UserController@index')->name('user');
    Route::post('/adduser', 'UserController@store')->name('adduser');
    Route::get('/users/approve/{id}', [App\Http\Controllers\UserController::class, 'approve'])->name('users.approve');
    Route::get('/pending', [App\Http\Controllers\UserController::class, 'pending'])->name('pending');

    // Category
    Route::get('/categories', [App\Http\Controllers\CategoryController::class, "index"])->name("categories");
    Route::post('/addcategory', 'CategoryController@store')->name('addcategory');
    Route::get('/categories/edit/{id}', [App\Http\Controllers\CategoryController::class, "edit"])->name("categories.edit");
    Route::post('/categories/update/{id}', [App\Http\Controllers\CategoryController::class, "update"])->name("categories.update");
    // Route::get('/categories/delete/{id}', [App\Http\Controllers\CategoryController::class, "destroy"])->name("categories.destroy");

    Route::get('/get-video-url/{id}', [App\Http\Controllers\RegisteredCoursesController::class, "get_video_url"])->name("get-video-url");



    /** Quiz */
    Route::get('/quiz', [App\Http\Controllers\QuizController::class, "index"])->name("quiz");
    Route::get('/quiz/create', [App\Http\Controllers\QuizController::class, "create"])->name("quiz.create");
    Route::post('/quiz/store', [App\Http\Controllers\QuizController::class, "store"])->name("quiz.store");
    Route::get('/quiz/view/{id}', [App\Http\Controllers\QuizController::class, "show"])->name("quiz.view");
    Route::get('/quiz/edit/{id}', [App\Http\Controllers\QuizController::class, "edit"])->name("quiz.edit");
    Route::post('/quiz/update', [App\Http\Controllers\QuizController::class, "update"])->name("quiz.update");
    Route::get('/quiz/delete/{id}', [App\Http\Controllers\QuizController::class, "destroy"])->name("quiz.delete");
    /** /.Quiz */

    /** Quiz Questions */
    Route::get('/questions/{quiz_id}', [App\Http\Controllers\QuestionController::class, "create"])->name('questions');
    Route::post('/question/store', [App\Http\Controllers\QuestionController::class, "store"])->name('question.store');
    Route::get('/questions/get/{quiz_id}', [App\Http\Controllers\QuestionController::class, "get_all_by_quiz_id"])->name('questions.get');
    Route::get('/question/destroy/{question_id}', [App\Http\Controllers\QuestionController::class, "destroy"])->name('question.destroy');
    Route::get('/question/get/{question_id}', [App\Http\Controllers\QuestionController::class, "get_single_by_id"])->name('question.get');
    Route::post('/question/update', [App\Http\Controllers\QuestionController::class, "update"])->name('question.update');

    /** /. Quiz Questions */
});

Route::middleware("can:isMentor")->group(function () {
    /** Quiz */
    Route::get('/quiz', [App\Http\Controllers\QuizController::class, "index"])->name("quiz");
    Route::get('/quiz/create', [App\Http\Controllers\QuizController::class, "create"])->name("quiz.create");
    Route::post('/quiz/store', [App\Http\Controllers\QuizController::class, "store"])->name("quiz.store");
    Route::get('/quiz/view/{id}', [App\Http\Controllers\QuizController::class, "show"])->name("quiz.view");
    Route::get('/quiz/edit/{id}', [App\Http\Controllers\QuizController::class, "edit"])->name("quiz.edit");
    Route::post('/quiz/update', [App\Http\Controllers\QuizController::class, "update"])->name("quiz.update");
    Route::get('/quiz/delete/{id}', [App\Http\Controllers\QuizController::class, "destroy"])->name("quiz.delete");
    /** /.Quiz */

    /** Quiz Questions */
    Route::get('/questions/{quiz_id}', [App\Http\Controllers\QuestionController::class, "create"])->name('questions');
    Route::post('/question/store', [App\Http\Controllers\QuestionController::class, "store"])->name('question.store');
    Route::get('/questions/get/{quiz_id}', [App\Http\Controllers\QuestionController::class, "get_all_by_quiz_id"])->name('questions.get');
    Route::get('/question/destroy/{question_id}', [App\Http\Controllers\QuestionController::class, "destroy"])->name('question.destroy');
    Route::get('/question/get/{question_id}', [App\Http\Controllers\QuestionController::class, "get_single_by_id"])->name('question.get');
    Route::post('/question/update', [App\Http\Controllers\QuestionController::class, "update"])->name('question.update');

    /** /. Quiz Questions */
});

/** User */
Route::prefix('user')->middleware("can:isUser")->group(function () {
    Route::get('/view-courses', [App\Http\Controllers\CourseController::class, "viewCourses"])->name('user.view-courses');
    Route::get('/checkout/{course_id}', [App\Http\Controllers\GeneralController::class, "checkout"])->name('user.checkout');
    Route::post('/complete_payment', [App\Http\Controllers\RegisteredCoursesController::class, "complete_payment"])->name('user.complete_payment');
    Route::get('/registered-course', [App\Http\Controllers\RegisteredCoursesController::class, "index"])->name('user.registered-course');
    Route::get('/view-course/{course_id}', [App\Http\Controllers\RegisteredCoursesController::class, "view"])->name('user.view-course');
    Route::get('/get-video-url/{id}', [App\Http\Controllers\RegisteredCoursesController::class, "get_video_url"])->name("user.get-video-url");
    Route::get('/test/{id}', [App\Http\Controllers\QuizController::class, "test"])->name("test");
    Route::post('/submitQuiz', [App\Http\Controllers\QuizController::class, 'submitQuiz'])->name('user.submit_quiz');

    Route::get('/jobs/view', [App\Http\Controllers\JobController::class, 'view_all'])->name('jobs.view');
    Route::get('/job/apply/{job_id}', [App\Http\Controllers\JobController::class, 'apply'])->name('job.apply');
    Route::get('user/applied-jobs', [App\Http\Controllers\JobController::class, 'applied_jobs'])->name('user.applied-jobs');
});
/** /.User */
