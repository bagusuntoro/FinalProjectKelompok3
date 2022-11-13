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
], function(){
    Route::group([
        // aku comment dulu middleware nya, biar ga perlu login saat nyoba API nya
        'middleware' => 'auth:api'
    ], function(){
        Route::get('/','App\Http\Controllers\InstructionController@showAll');
        Route::get('/{id}', 'App\Http\Controllers\InstructionController@detailInstruction'); // menampilkan detail data instruction
        Route::post('/add', 'App\Http\Controllers\InstructionController@storeData'); //menambah data instruction baru
        Route::post('/delete', 'App\Http\Controllers\InstructionController@deleteInstruction');
        Route::get('/draft', 'App\Http\Controllers\InstructionController@getDraft');
        Route::get('/onprogress', 'App\Http\Controllers\InstructionController@getOnProgress');
        Route::get('/completed', 'App\Http\Controllers\InstructionController@getCompleted');
        Route::get('/terminated', 'App\Http\Controllers\InstructionController@getTerminated');
        Route::get('/search/', 'App\Http\Controllers\InstructionController@search')->name('search');
       
    }); 
});
