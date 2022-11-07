<?php

use App\Http\Controllers\InstructionController;
use App\Models\Instruction;
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

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::post('logout', 'App\Http\Controllers\AuthController@logout');
    });
});

Route::group([
    'prefix' => 'instruction',
], function () {
    Route::group([
        // karena auth nya belum jalan, jadi aku comment dulu middleware nya
        // 'middleware' => 'auth:api'
    ], function () {
        Route::post('/', 'App\Http\Controllers\InstructionController@showInstructions');
        Route::post('/add', 'App\Http\Controllers\InstructionController@storeData');
        Route::post('/delete', 'App\Http\Controllers\InstructionController@deleteInstruction');
    });
});
