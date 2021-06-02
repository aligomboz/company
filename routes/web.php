<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PaymentClientController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectEmployeeController;
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
    return view('welcome');
});
Route::prefix('admin')->group(function () {
    Route::get('/dashboard',[dashboardController::class ,'index']);
    Route::resource('clients', ClientController::class);
    Route::resource('projects', ProjectController::class);
    Route::post('upload_attachment', [ProjectController::class,'upload_attachment'])->name('upload_attachment');
    Route::get('download_attachment/{projectname}/{filename}', [ProjectController::class,'download_attachment'])->name('download_attachment');
    Route::post('delete_attachment', [ProjectController::class,'delete_attachment'])->name('delete_attachment');
    Route::resource('employees', EmployeeController::class);
    Route::resource('embloyeeProjects', ProjectEmployeeController::class);
    Route::resource('payments', PaymentController::class);
    Route::resource('paymentClients', PaymentClientController::class);
    Route::get('clientProject/{id}',[PaymentClientController::class,'clientProject']);
    Route::get('projectPrice/{id}',[PaymentClientController::class,'projectPrice']);
    
});