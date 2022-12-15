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

// Route::get('/', function () {
//     return view('home');
// });

// Route::get('/', function(){
//     return view('welcome');
// });
// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


<<<<<<< HEAD
Route::get('/report', [App\Http\Controllers\ReportController::class, 'index'])->name('index');
=======
Route::get('/export', [App\Http\Controllers\InstructionController::class, 'export']);
Route::post('/export', [App\Http\Controllers\InstructionController::class, 'exportInstructions']);
>>>>>>> 43c2329b7656fe2b602db07e664a2ca714f6eca3

Route::get('/{any}', function(){
    return view('home');
})->where('any', '.*');
