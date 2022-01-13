<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\GroupController;

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

Route::get('sessions', [SessionController::class, 'index']);
Route::get('ideas', [IdeaController::class, 'index']);
Route::get('ideas/votes_first', [IdeaController::class, 'getIdeasWithVotes']);
Route::get('groups', [GroupController::class, 'index']);
Route::post('ideas/create', [IdeaController::class, 'store']);
Route::post('ideas/criteria/votes_first/{id}', [IdeaController::class, 'update']);
Route::post('ideas/votes_first/{id}', [IdeaController::class, 'updateFirst']);
Route::post('ideas/votes_second/{id}', [IdeaController::class, 'updateSecond']);
Route::post('ideas/groups', [IdeaController::class, 'updateWithGroups']);
Route::get('ideas/winner', [IdeaController::class, 'getWinner']);
