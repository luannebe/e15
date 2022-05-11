<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;

use App\Http\Controllers\PracticeController;
use App\Http\Controllers\ReporterController;
use App\Http\Controllers\TrackerController;


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

// Public Routes
Route::get('/', [ReporterController::class, 'welcome']);
Route::get('/make-a-report', [ReporterController::class, 'create']);
Route::post('make-a-report', [ReporterController::class, 'store']);

// Private Routes
Route::group(['middleware' => 'auth'], function() {
    # lists all reports
    Route::get('/tracker', [TrackerController::class, 'index']);
    # show the page to confirm deletion
    Route::get('tracker/{id}/delete', [TrackerController::class, 'delete']);
    # process the page deletion
    Route::delete('tracker/{id}', [TrackerController::class, 'destroy']);
});