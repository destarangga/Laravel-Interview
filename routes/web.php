<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InterviewController;
use App\Http\Controllers\ResponseController;


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

Route::get('/', [InterviewController::class, 'index'])->name('landing');

Route::get('/login', function () {
    return view('login');
})->name ('login');

// Route::middleware(['IsLogin' ,'CekRole:petugas'])->group(function(){
// Route::get('/data/petugas', [InterviewController::class, 'detailPetugas'])->name('data.petugas')});Route::middleware(['IsLogin' ,'CekRole:petugas'])->group(function(){
//     Route::get('/data/petugas', [InterviewController::class, 'detailPetugas'])->name('data.petugas');
//     Route::get('/response/edit/{report_id}', [ResponseController::class, 'edit'])->name('response.edit');
//     Route::patch('/response/update/{report_id}', [ResponseController::class, 'update'])->name('response.update');
    
// });
Route::middleware(['IsLogin', 'CekRole:admin,petugas'])->group(function(){
    Route::get('/logout', [InterviewController::class, 'logout'])->name('logout');
});

Route::middleware(['IsLogin' ,'CekRole:petugas'])->group(function(){
    Route::get('/data/petugas', [InterviewController::class, 'detailPetugas'])->name('data.petugas');
    Route::get('/response/edit/{interview_id}', [ResponseController::class, 'edit'])->name('response.edit');
    Route::patch('/response/update/{interview_id}', [ResponseController::class, 'update'])->name('response.update');
    
});
Route::middleware(['IsLogin', 'CekRole:admin'])->group(function(){
    Route::get('/data', [InterviewController::class, 'data'])->name ('data');
    Route::get('/export/pdf', [InterviewController::class, 'exportPDF'])->name('export-pdf');
    Route::delete('/hapus/{id}', [InterviewController::class, 'destroy'])->name('delete');
    Route::get('/export/excel', [InterviewController::class, 'exportExcel'])->name('export.excel');
    
    });


Route::post('store', [InterviewController::class, 'store'])->name('store');
Route::post('/auth', [InterviewController::class, 'auth'])->name('auth');


