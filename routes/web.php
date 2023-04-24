<?php

use App\Http\Controllers\AccountReceivableController;
use App\Http\Controllers\AvatarUploadController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\ExerciceController;
use App\Http\Controllers\HelperController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\InstructorModalityController;
use App\Http\Controllers\ModalityController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\StudentController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('helper/zipcode/{zipcode}', [HelperController::class, 'zipcodeApi'])->name('helper.zipcode');
Route::get('user/avatar/{user}', [AvatarUploadController::class, 'index'])->name('avatar.index');
Route::post('user/avatar/{user}', [AvatarUploadController::class, 'store'])->name('avatar.store');


Route::resource('home', HomeController::class);
Route::resource('student', StudentController::class);
Route::resource('instructor', InstructorController::class);
Route::resource('instructor/{instructor}/modality', InstructorModalityController::class)->names('instructor.modality');
Route::resource('modality', ModalityController::class);
Route::resource('exercice', ExerciceController::class);
Route::resource('registration', RegistrationController::class);
Route::get('registration/{registration}/cancel', [RegistrationController::class, 'cancel'])->name('registration.cancel');
Route::post('registration/{registration}/abort', [RegistrationController::class, 'abort'])->name('registration.abort');
Route::get('registration/{registration}/renew', [RegistrationController::class, 'renew'])->name('registration.renew');


Route::resource('class', ClassesController::class);
Route::put('class/{class}/absense', [ClassesController::class, 'absense'])->name('class.absense');
Route::put('class/{class}/presence', [ClassesController::class, 'presence'])->name('class.presence');
Route::put('class/{class}/reset', [ClassesController::class, 'reset'])->name('class.reset');
Route::put('class/{class}/remark', [ClassesController::class, 'remark'])->name('class.remark');

Route::resource('calendar', CalendarController::class);
Route::get('calendar/{id}/absense', [CalendarController::class, 'absense'])->name('calendar.absense');
Route::get('calendar/{id}/presence', [CalendarController::class, 'presence'])->name('calendar.presence');
Route::get('calendar/{id}/evolution', [CalendarController::class, 'evolution'])->name('calendar.evolution');
Route::get('calendar/{id}/remark', [CalendarController::class, 'remark'])->name('calendar.remark');


Route::resource('account/receive', AccountReceivableController::class);

// Route::get('calendar', [CalendarController::class, 'index'])->name('calendar.index');

require __DIR__.'/auth.php';
