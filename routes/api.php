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
], function(){
    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::post('signup', 'App\Http\Controllers\AuthController@signup');
    Route::group([
        'middleware' => 'auth:api'
    ], function(){
        Route::post('logout', 'App\Http\Controllers\AuthController@logout');
        Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
        Route::get('data', 'App\Http\Controllers\AuthController@data');
    });
});

Route::group([
    'prefix' => 'instruction',
], function(){
    Route::group([
        // Harap login dulu
        'middleware' => 'auth:api'
    ], function(){
        Route::get('/', 'App\Http\Controllers\InstructionController@showInstructions'); // menampilkan semua data instruction        
        Route::post('/add', 'App\Http\Controllers\InstructionController@storeData'); //menambah data instruction baru
        Route::post('/delete', 'App\Http\Controllers\InstructionController@deleteInstruction');
        Route::get('/draft', 'App\Http\Controllers\InstructionController@getDraft'); //menampilkan data instruction yang memiliki status on draft
        Route::get('/onprogress', 'App\Http\Controllers\InstructionController@getOnProgress'); //menampilkan data instruction yang memiliki status on progress
        Route::get('/completed', 'App\Http\Controllers\InstructionController@getCompleted'); //menampilkan data instruction yang memiliki status completed
        Route::get('/terminated', 'App\Http\Controllers\InstructionController@getTerminated'); //menampilkan data instruction yang memiliki status terminated
        Route::get('/search/', 'App\Http\Controllers\InstructionController@search')->name('search');   
        Route::get('/{id}', 'App\Http\Controllers\InstructionController@detailInstruction'); // menampilkan detail data instruction
    }); 
});
