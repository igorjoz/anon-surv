<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\UserController;
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

Auth::routes();

Route::get('/', [HomeController::class, 'index'])
    ->name('home.index');

Route::resource('survey', SurveyController::class, [
    // 'only' => ['index', 'show',]
]);

Route::resource('user', UserController::class, [
    // 'only' => ['index', 'show',]
]);

Route::get('admin', function () {
    return view('admin');
});
