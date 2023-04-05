<?php

use App\Http\Controllers\ExerciceController;
use App\Http\Controllers\HelperController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ModalityController;
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

Route::resource('home', HomeController::class);
Route::resource('student', StudentController::class);
Route::resource('modality', ModalityController::class);
Route::resource('exercice', ExerciceController::class);

require __DIR__.'/auth.php';
