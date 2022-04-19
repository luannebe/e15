<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\PracticeController;

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

Route::any('/practice/{n?}', [PracticeController::class, 'index']);

Route::get('/', [PageController::class, 'welcome']);
Route::get('/contact', [PageController::class, 'contact']);

Route::group(['middleware' => 'auth'], function() {

    Route::get('authors/create', [AuthorController::class, 'create']);
    Route::post('/authors', [AuthorController::class, 'store']);
    Route::get('authors/{author_id}/edit', [AuthorController::class, 'edit']);
    Route::put('authors/{author_id}', [AuthorController::class, 'update']);

    Route::get('books/create', [BookController::class, 'create']);
    Route::get('books/{slug}/edit', [BookController::class, 'edit']);
    Route::put('books/{slug}', [BookController::class, 'update']);
    # show the page to confirm deletion
    Route::get('books/{slug}/delete', [BookController::class, 'delete']);
    # process the page deletion
    Route::delete('books/{slug}', [BookController::class, 'destroy']);
    Route::post('/books', [BookController::class, 'store']);
    Route::get('/books', [BookController::class, 'index']);
    Route::get('/search', [BookController::class, 'search']);
    Route::get('/books/{slug}', [BookController::class, 'show']);
    Route::get('/books/filter/{category}/{subcategory}', [BookController::class, 'filter']);
    Route::get('/list', [ListController::class, 'show']);
});