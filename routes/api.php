<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\Me\TeamController;
use App\Http\Controllers\Api\CommentController;

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
    Route::apiResource('/me/tasks', App\Http\Controllers\Api\Me\TaskController::class, ['only' => 'index']);
    Route::apiResource('/me/teams', TeamController::class);
    Route::apiResource('/tasks', App\Http\Controllers\Api\TaskController::class, ['only' => 'show']);
    Route::apiResource('/tasks.comments', CommentController::class, ['only' => ['index', 'store']]);
});
