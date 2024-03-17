<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\Me\TeamController;
use App\Http\Controllers\Api\Me\TaskController;
use App\Http\Controllers\Api\Me\CommentController;

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

Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout']);

Route::middleware(['auth:sanctum', 'ensureAdmin'])->group(function () {
    Route::apiResource('/users', UserController::class);
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('/me/tasks', TaskController::class);
    Route::apiResource('/me/tasks.comments', CommentController::class, ['only' => ['index', 'store']]);
    Route::apiResource('/me/teams', TeamController::class);
});
