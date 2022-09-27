<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\UserController;
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

// * create Auth routes - login, registration, etc.
Auth::routes();

// * only authenticated users can access routes other than Auth routes
Route::middleware(['auth'])->group(function () {
    Route::group(['middleware' => ['can:delete users']], function () {
        Route::resource('user', UserController::class);
    });

    Route::get('/', [HomeController::class, 'index'])
        ->name('home.index');

    Route::get('edytuj-konto', [UserController::class, 'editAccount'])
        ->name('user.edit_account');
    Route::put('edytuj-konto', [UserController::class, 'updateAccount'])
        ->name('user.update_account');

    Route::resource('survey', SurveyController::class);
    Route::get('wyswietl-ankiety', [SurveyController::class, 'indexUserSurveys'])
        ->name('survey.index_user_surveys');

    Route::resource('question', QuestionController::class, [
        'except' => ['show']
    ]);
});
