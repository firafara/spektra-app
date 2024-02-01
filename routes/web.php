<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use App\Http\Controllers;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/viewdetailextra/{extracurricular_id}',[App\Http\Controllers\ExtracurricularController::class, 'viewdetailextra'])->name('viewdetailextra');

Route::get('/extraview',[App\Http\Controllers\ExtracurricularController::class, 'extraview']);

Route::get('/register',[AuthController::class,'register']);
Route::post('/registerProses',[AuthController::class,'registerProses']);


Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware'=> 'auth'],function(){
    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::get('/class/datatable', [App\Http\Controllers\ClassController::class, 'datatable'])->name('class/datatable')->middleware('role:Super Admin,Admin');
    Route::get('/class', [App\Http\Controllers\ClassController::class, 'index'])->middleware('role:Super Admin,Admin');
    Route::get('/class/edit/{class_id}', [App\Http\Controllers\ClassController::class, 'edit'])->middleware('role:Super Admin,Admin');
    Route::post('/class/store', [App\Http\Controllers\ClassController::class, 'store'])->name('class/store')->middleware('role:Super Admin,Admin');
    Route::post('/class/update/{class_id}', [App\Http\Controllers\ClassController::class, 'update'])->name('class/update')->middleware('role:Super Admin,Admin');
    Route::any('/class/delete/{id}', [App\Http\Controllers\ClassController::class, 'destroy'])->middleware('role:Super Admin,Admin');

    Route::get('/user/datatable',[App\Http\Controllers\UserController::class, 'datatable'])->name('user/datatable')->middleware('role:Super Admin,Admin,Student');
    Route::get('/user',[App\Http\Controllers\UserController::class, 'index'])->middleware('role:Super Admin,Admin,Student');
    Route::get('/user/create', [App\Http\Controllers\UserController::class, 'create'])->name('user/create')->middleware('role:Super Admin');
    Route::get('/user/show/{id}',[App\Http\Controllers\UserController::class, 'show'])->middleware('role:Super Admin');
    Route::get('/user/edit/{id}',[App\Http\Controllers\UserController::class, 'edit'])->middleware('role:Super Admin');
    Route::post('/user/store',[App\Http\Controllers\UserController::class, 'store'])->name('user/store')->middleware('role:Super Admin');
    Route::post('/user/update/{id}',[App\Http\Controllers\UserController::class, 'update'])->name('user/update')->middleware('role:Super Admin,Student');
    Route::any('/user/delete/{id}',[App\Http\Controllers\UserController::class, 'destroy'])->middleware('role:Super Admin');
    Route::get('users/profile/{id}',[App\Http\Controllers\UserController::class, 'profile'])->name('user.profile')->middleware('role:Student');
    Route::post('users/update/profile/{id}',[App\Http\Controllers\UserController::class, 'update_profile'])->name('user/update/profile')->middleware('role:Student');

    Route::get('/student/datatable',[App\Http\Controllers\StudentController::class, 'datatable'])->name('student/datatable')->middleware('role:Super Admin,Admin,Student');
    Route::get('/student',[App\Http\Controllers\StudentController::class, 'index'])->middleware('role:Super Admin,Admin,Student');
    Route::get('/student/create', [App\Http\Controllers\StudentController::class, 'create'])->name('student/create')->middleware('role:Super Admin,Admin,Student');
    Route::get('/student/show/{id}',[App\Http\Controllers\StudentController::class, 'show'])->middleware('role:Super Admin,Admin,Student');
    Route::get('/student/edit/{id}',[App\Http\Controllers\StudentController::class, 'edit'])->middleware('role:Super Admin,Admin,Student');
    Route::post('/student/store',[App\Http\Controllers\StudentController::class, 'store'])->name('student/store')->middleware('role:Super Admin,Admin,Student');
    Route::post('/student/update/{id}',[App\Http\Controllers\StudentController::class, 'update'])->name('student/update')->middleware('role:Super Admin,Admin,Student');
    Route::any('/student/delete/{id}',[App\Http\Controllers\StudentController::class, 'destroy'])->middleware('role:Super Admin,Admin,Student');

    Route::get('/teacher/datatable',[App\Http\Controllers\TeacherController::class, 'datatable'])->name('teacher/datatable')->middleware('role:Super Admin,Admin');
    Route::get('/teacher',[App\Http\Controllers\TeacherController::class, 'index'])->middleware('role:Super Admin,Admin');
    Route::get('/teacher/create', [App\Http\Controllers\TeacherController::class, 'create'])->name('teacher/create')->middleware('role:Super Admin,Admin');
    Route::get('/teacher/show/{id}',[App\Http\Controllers\TeacherController::class, 'show'])->middleware('role:Super Admin,Admin');
    Route::get('/teacher/edit/{id}',[App\Http\Controllers\TeacherController::class, 'edit'])->middleware('role:Super Admin,Admin');
    Route::post('/teacher/store',[App\Http\Controllers\TeacherController::class, 'store'])->name('teacher/store')->middleware('role:Super Admin,Admin');
    Route::post('/teacher/update/{id}',[App\Http\Controllers\TeacherController::class, 'update'])->name('teacher/update')->middleware('role:Super Admin,Admin');
    Route::any('/teacher/delete/{id}',[App\Http\Controllers\TeacherController::class, 'destroy'])->middleware('role:Super Admin,Admin');

    Route::get('/achievement/datatable',[App\Http\Controllers\AchievementController::class, 'datatable'])->name('achievement/datatable')->middleware('role:Super Admin,Admin');
    Route::get('/achievement',[App\Http\Controllers\AchievementController::class, 'index'])->middleware('role:Super Admin,Admin');
    Route::get('/achievement/create', [App\Http\Controllers\AchievementController::class, 'create'])->name('achievement/create')->middleware('role:Super Admin,Admin');
    Route::get('/achievement/show/{id}',[App\Http\Controllers\AchievementController::class, 'show'])->middleware('role:Super Admin,Admin');
    Route::get('/achievement/edit/{id}',[App\Http\Controllers\AchievementController::class, 'edit'])->middleware('role:Super Admin,Admin');
    Route::post('/achievement/store',[App\Http\Controllers\AchievementController::class, 'store'])->name('achievement/store')->middleware('role:Super Admin,Admin');
    Route::post('/achievement/update/{id}',[App\Http\Controllers\AchievementController::class, 'update'])->name('achievement/update')->middleware('role:Super Admin,Admin');
    Route::any('/achievement/delete/{id}',[App\Http\Controllers\AchievementController::class, 'destroy'])->middleware('role:Super Admin,Admin');

    Route::get('/extracurricular/datatable',[App\Http\Controllers\ExtracurricularController::class, 'datatable'])->name('extracurricular/datatable')->middleware('role:Super Admin,Admin');
    Route::get('/extracurricular',[App\Http\Controllers\ExtracurricularController::class, 'index'])->middleware('role:Super Admin,Admin');
    Route::get('/extracurricular/create', [App\Http\Controllers\ExtracurricularController::class, 'create'])->name('extracurricular/create')->middleware('role:Super Admin,Admin');
    Route::get('/extracurricular/show/{id}',[App\Http\Controllers\ExtracurricularController::class, 'show'])->middleware('role:Super Admin,Admin');
    Route::get('/extracurricular/edit/{id}',[App\Http\Controllers\ExtracurricularController::class, 'edit'])->middleware('role:Super Admin,Admin');
    Route::post('/extracurricular/store',[App\Http\Controllers\ExtracurricularController::class, 'store'])->name('extracurricular/store')->middleware('role:Super Admin,Admin');
    Route::post('/extracurricular/update/{id}',[App\Http\Controllers\ExtracurricularController::class, 'update'])->name('extracurricular/update')->middleware('role:Super Admin,Admin');
    Route::any('/extracurricular/delete/{id}',[App\Http\Controllers\ExtracurricularController::class, 'destroy'])->middleware('role:Super Admin,Admin');

    Route::get('/registration/datatable',[App\Http\Controllers\RegistrationController::class, 'datatable'])->name('registration/datatable')->middleware('role:Super Admin,Admin,Student');
    Route::get('/registration',[App\Http\Controllers\RegistrationController::class, 'index'])->middleware('role:Super Admin,Admin,Student');
    Route::get('/registration/create', [App\Http\Controllers\RegistrationController::class, 'create'])->name('registration/create')->middleware('role:Super Admin,Admin,Student');
    Route::get('/registration/show/{id}',[App\Http\Controllers\RegistrationController::class, 'show'])->middleware('role:Super Admin,Admin,Student');
    Route::get('/registration/edit/{id}',[App\Http\Controllers\RegistrationController::class, 'edit'])->middleware('role:Super Admin,Admin,Student');
    Route::post('/registration/store',[App\Http\Controllers\RegistrationController::class, 'store'])->name('registration/store')->middleware('role:Super Admin,Admin,Student');
    Route::post('/registration/update/{id}',[App\Http\Controllers\RegistrationController::class, 'update'])->name('registration/update')->middleware('role:Super Admin,Admin,Student');
    Route::any('/registration/delete/{id}',[App\Http\Controllers\RegistrationController::class, 'destroy'])->middleware('role:Super Admin,Admin,Student');
    Route::get('/registration/download/{id}', [App\Http\Controllers\RegistrationController::class, 'downloadApprovalLetter'])->name('registration.download')->middleware('role:Super Admin,Admin,Student');
});
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/loginProses', [AuthController::class, 'loginProses']); // Assuming your loginProses route is also part of the login process

// Catch-all route for redirection
Route::get('/{any}', function () {
    return redirect()->route('login');
})->where('any', '.*')->middleware('guest');

