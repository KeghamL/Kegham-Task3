<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TeacherController;

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

Route::get('/', [UserController::class, 'home']);
Route::post('/register', [UserController::class, 'registeration']);
Route::get('/login', [UserController::class, 'login']);
Route::post('/dashboard', [UserController::class, 'loginUser'])->middleware('visited');
Route::get('/teacherdashboard', [TeacherController::class, 'teacherdashboard']);
Route::group(
    ['middleware' => 'auth'],
    function () {
        Route::group(
            ['middleware' => 'visited'],
            function () {
                Route::get('/studentdashboard', [UserController::class, 'studentdashboard']);
                Route::get('/admindashboard', [AdminController::class, 'admindashboard']);
                Route::get('/logout', [UserController::class, 'logout'])->name('logout');
                Route::get('/updateadmin', [AdminController::class, 'updateadmin']);
                Route::get('/updatestudent', [UserController::class, 'updatestudent']);
                Route::put('/adminupdate/{id}', [AdminController::class, 'adminupdate'])->name('admin-update');
                Route::get('/course', [AdminController::class, 'course']);
                Route::post('/savecourse', [AdminController::class, 'savecourse']);
                Route::delete('/deletecourse/{course}', [AdminController::class, 'deletecourse'])->name('delete-course');
                Route::get('/showeditcourse{course}', [AdminController::class, 'showeditcourse'])->name('showedit-course');
                Route::put('/editcourse/{course}', [AdminController::class, 'editcourse'])->name('edit-course');
                Route::get('/subject', [AdminController::class, 'subject']);
                Route::post('/savesubject', [AdminController::class, 'savesubject']);
                Route::delete('/deletesubject/{subject}', [AdminController::class, 'deletesubject'])->name('delete-subject');
                Route::get('/showeditsubject{subject}', [AdminController::class, 'showeditsubject'])->name('showedit-subject');
                Route::put('/editsubject/{subject}', [AdminController::class, 'editsubject'])->name('edit-subject');;
                Route::get('/teacher', [AdminController::class, 'teacher']);
                Route::post('/addteacher', [AdminController::class, 'addteacher']);
                Route::get('/manageteacher', [AdminController::class, 'manageteacher']);
                Route::delete('/deleteteacher/{user}', [AdminController::class, 'deleteteacher'])->name('delete-teacher');
                Route::get('/showeditteacher{user}', [AdminController::class, 'showeditteacher'])->name('showedit-teacher');
                Route::put('/editteacher/{user}', [AdminController::class, 'editteacher']);
                Route::get('/news', [AdminController::class, 'news']);
                Route::post('/addnews', [AdminController::class, 'addnews']);
                Route::delete('/deletenews/{news}', [AdminController::class, 'deletenews'])->name('delete-news');
                Route::get('/assignment', [TeacherController::class, 'assignment'])->name('assignment');
                Route::post('/addassignment', [TeacherController::class, 'addassignment']);
                Route::get('/manageassignment', [TeacherController::class, 'manageassignment']);
                Route::delete('/deleteassignment{assignment}', [TeacherController::class, 'deleteassignment'])->name('delete-assignment');
                Route::get('/showeditassignment{assignment}', [TeacherController::class, 'showeditassignment'])->name('showedit-assignment');
                Route::put('/editassignment{assignment}', [TeacherController::class, 'editassignment']);
                Route::get('/announcment', [TeacherController::class, 'announcment']);
                Route::post('/addannouncment', [TeacherController::class, 'addannouncment']);
                Route::delete('/deleteannouncment{announcement}', [TeacherController::class, 'deleteannouncment'])->name('delete-announcment');
                Route::get('/registeredusers', [TeacherController::class, 'registeredusers']);
                Route::get('/newassignment', [UserController::class, 'newassignment'])->name('new-assignment');
                Route::get('/answer', [UserController::class, 'answer'])->name('answer');
                Route::post('/addanswer', [UserController::class, 'addanswer']);
                Route::get('/unchecked', [TeacherController::class, 'unchecked']);
                Route::get('/checked', [TeacherController::class, 'checked']);
                Route::get('/checkassignment{id}', [TeacherController::class, 'checkassignment'])->name('check-assignment');
                Route::get('/uncheckassignment{id}', [TeacherController::class, 'uncheckassignment'])->name('uncheck-assignment');
                Route::get('/showanswer/{id}', [TeacherController::class, 'showanswer'])->name('show-answer');
                Route::get('/givemark', [TeacherController::class, 'givemark'])->name('give-mark');
                Route::post('/submitmark', [TeacherController::class, 'submitmark'])->name('submit-mark');
                Route::get('/uncheckedadmin', [AdminController::class, 'uncheckedadmin']);
                Route::get('/checkedadmin', [AdminController::class, 'checkedadmin']);
                Route::get('/showansweradmin/{id}', [AdminController::class, 'showansweradmin'])->name('show-answeradmin');
                Route::get('/uploaded', [UserController::class, 'uploade'])->name('uploaded');
                Route::get('/showanswerstudent/{id}', [UserController::class, 'showanswerstudent'])->name('show-answerstudent');
                Route::get('/search', [AdminController::class, 'search']);
                Route::get('/searchassignment', [AdminController::class, 'searchassignment']);
                Route::get('/searchteacher', [TeacherController::class, 'search']);
                Route::get('/fullsearch', [TeacherController::class, 'fullsearch']);
                Route::get('/changeadminpassword', [AdminController::class, 'changeadminpassword']);
                Route::post('/updateadminpassword', [AdminController::class, 'updateadminpassword']);
                Route::get('/changestudentpassword', [UserController::class, 'changestudentpassword']);
                Route::post('/updatestudentpassword', [UserController::class, 'updatestudentpassword']);
                Route::get('/changeteacherpassword', [TeacherController::class, 'changeteacherpassword']);
                Route::post('/updateteacherpassword', [TeacherController::class, 'updateteacherpassword']);
                Route::get('/updateteacher', [TeacherController::class, 'updateteacher']);
                Route::get('/statisticspage', [AdminController::class, 'statistics']);
                Route::delete('/statisticsdelete', [AdminController::class, 'deletestatistics'])->name('statistics-delete');
            }
        );
    }
);
