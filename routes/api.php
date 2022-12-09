<?php

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

        // instruction
        Route::post('/add', 'App\Http\Controllers\InstructionController@storeData'); //menambah data instruction baru
        Route::post('/edit/{id}', 'App\Http\Controllers\InstructionController@editData'); //mengedit data instruction
        Route::post('/add_draft', 'App\Http\Controllers\InstructionController@draftData'); //menambah data instruction sebagai draft
        Route::put('/edit/{id}', 'App\Http\Controllers\InstructionController@editData'); //mengedit data instruction
        Route::post('/terminate', 'App\Http\Controllers\InstructionController@setTerminated'); //mengubah status menjadi terminated
        Route::post('/set_on_progress', 'App\Http\Controllers\InstructionController@setOnProgress'); //mengubah status menjadi on progress
        Route::post('/delete', 'App\Http\Controllers\InstructionController@deleteInstruction'); // menghapus instruction
        Route::post('/delete/costdetail', 'App\Http\Controllers\InstructionController@deleteCostDetail'); // menghapus cost detail

        // invoice of instruction
        Route::get('/allInvoices/{id}', 'App\Http\Controllers\VendorInvoiceController@getAllInstructionInvoice')->name('allInvoices'); //mengambil semua invoices dari instruction id tertentu
        Route::post("/addVendorInvoice", 'App\Http\Controllers\VendorInvoiceController@addVendorInvoice')->name('addVendorInvoice'); //menambah vendor invoice
        Route::post("/receiveVendorInvoice/{id}", 'App\Http\Controllers\VendorInvoiceController@receiveVendorInvoice')->name('receiveVendorInvoice'); //menerima vendor invoice
        Route::put('/updateInvoice/{id}', 'App\Http\Controllers\VendorInvoiceController@updateInvoice')->name('updateInvoice');
        Route::post('/deleteSupDocument', 'App\Http\Controllers\VendorInvoiceController@removeSupportingDocument')->name('deleteSupDocument');
        Route::delete('/deleteAttachment/{id}', 'App\Http\Controllers\VendorInvoiceController@removeAttachment')->name('deleteAttachment');
        Route::delete('/deleteInvoice/{id}', 'App\Http\Controllers\VendorInvoiceController@destroy')->name('deleteInvoice');

        // internal only section
        Route::get('/internal/attachment/{id}', 'App\Http\Controllers\InternalFilesController@getAllInternalAttachment'); //mengambil semua internal attachment dari instruction id tertentu
        Route::post("/internal/attachment/add", 'App\Http\Controllers\InternalFilesController@addAttachment'); //menambah internal attachment
        Route::delete('/internal/attachment/delete/{id}','App\Http\Controllers\InternalFilesController@destroy'); //menghapus internal attachment

        Route::post("/internal/note/edit/{id}", 'App\Http\Controllers\InternalNotesController@editNote'); //mengubah internal Note
        Route::post("/internal/note/add", 'App\Http\Controllers\InternalNotesController@addNote'); //menambah internal Note
        Route::get('/internal/note/{id}', 'App\Http\Controllers\InternalNotesController@getAllInternalNotes'); //mengambil semua internal notes dari instruction id tertentu
        Route::delete('/internal/note/delete/{id}','App\Http\Controllers\InternalNotesController@destroy'); //menghapus internal attachment

        //History
        Route::get('/history/{id}', 'App\Http\Controllers\HistoryController@getHistoryByInstruction'); //mengambil semua history dari instruction id tertentu

        Route::get('/test', 'App\Http\Controllers\InstructionController@test');
        Route::get('/open', 'App\Http\Controllers\InstructionController@getOpen'); //menampilkan data instruction yang memiliki status on progress dan draft
        Route::get('/completed', 'App\Http\Controllers\InstructionController@getCompleted'); //menampilkan data instruction yang memiliki status completed dan terminated/cancelled
        Route::get('/search/', 'App\Http\Controllers\InstructionController@search')->name('search'); //fitur pencarian
        Route::get('/{id}', 'App\Http\Controllers\InstructionController@detailInstruction'); // menampilkan detail data instruction
    
    }); 
});