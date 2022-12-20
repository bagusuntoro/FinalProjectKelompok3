<?php

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

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/register', function () {
    return view('auth.register');
});

// Route::get('/', function(){
//     return view('welcome');
// });
// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// asli dari backend
// Route::get('/export', [App\Http\Controllers\InstructionController::class, 'export']);
// Route::post('/export', [App\Http\Controllers\InstructionController::class, 'exportInstructions']);



Route::get('/report', [App\Http\Controllers\InstructionController::class, 'export']);
Route::post('/export', [App\Http\Controllers\InstructionController::class, 'exportInstructions']);
// Route::get('/report', [App\Http\Controllers\ReportController::class, 'index'])->name('index');

Route::get('/{any}', function(){
    return view('dashboard');
})->where('any', '.*');
