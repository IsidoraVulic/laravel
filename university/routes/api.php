<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExamRegController;
use App\Http\Controllers\UserExamRegController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users', [UserController::class, 'index'])->name('users.index');
//Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');

Route::get('users/{id}/examregistrations', [UserExamRegController::class, 'index'])->name('users.examregs.index');

Route::resource('users.examregistrations', UserExamRegController::class)->only(['index']);

//Route::resource('examregistrations', ExamRegController::class);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::get('/profile', function(Request $request) {
        return auth()->user();
    });

    Route::resource('examregistrations', ExamRegController::class)->only(['update','store','destroy']);

    // API route for logout user
    Route::post('/logout', [AuthController::class, 'logout']);
});


Route::resource('examregistrations', ExamRegController::class)->only(['index']);

Route::get('examregistrations', [ExamRegController::class, 'index']);


