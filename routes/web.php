<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

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
    return redirect()->route("dashboard.index")->with("success", "Welcome to School Management App");
});

Route::group(["middleware" => ["auth"]], function () {
    Route::resource("dashboard", "App\Http\Controllers\DashboardController");
    Route::resource("user", "App\Http\Controllers\UserController");
    Route::resource("subject", "App\Http\Controllers\SubjectController");
    Route::resource("grade-level", "App\Http\Controllers\GradeLevelController");
    Route::resource("classes", "App\Http\Controllers\ClassesController");
    Route::resource("student", "App\Http\Controllers\StudentController");
    Route::resource("student-class", "App\Http\Controllers\StudentClassController");
    Route::resource("teacher", "App\Http\Controllers\TeacherController");
    Route::resource('gender', "App\Http\Controllers\GenderController");

    Route::get("subject/{subject}/delete", [\App\Http\Controllers\SubjectController::class, "destroy"])->name("subject.destroy");
    Route::get("grade-level/{gradeLevel}/delete", [\App\Http\Controllers\GradeLevelController::class, "destroy"])->name("grade-level.destroy");
});

Route::get("login", [\App\Http\Controllers\UserController::class, "login"])->name("login");
Route::post("login", [\App\Http\Controllers\UserController::class, "loginPost"])->name("login.post");

Route::get("register", [\App\Http\Controllers\UserController::class, "register"])->name("register");
Route::post("register", [\App\Http\Controllers\UserController::class, "registerPost"])->name("register.post");

Route::get("logout", [\App\Http\Controllers\UserController::class, "logout"])->name("logout");

Route::get('greeting/{locale}', function (string $locale) {
    if (!in_array($locale, ['en', 'kh'])) {
        abort(400);
    }
    App::setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
})->name("greeting");
