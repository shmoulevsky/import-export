<?php

use App\Http\Controllers\ExportController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\UserController;
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

Route::post('import', [ImportController::class, 'import']);
Route::post('export', [ExportController::class, 'export']);
Route::get('export/types', [ExportController::class, 'getTypes']);
Route::get('results', [ResultController::class, 'index']);
Route::get('users', [UserController::class, 'index']);
