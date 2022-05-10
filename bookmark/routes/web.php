<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\PracticeController;
use App\Http\Controllers\TestController;

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

Route::get('send-mail', function () {
   
    $details = [
        'title' => 'Mail from Bookmark',
        'body' => 'This is for testing email using Mailtrap'
    ];
   
    Mail::to('your_receiver_email@gmail.com')->send(new \App\Mail\MyTestMail($details));
   
    dd("Email is Sent.");
});

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
    Route::get('/list/{slug}/add', [ListController::class, 'add']);
    Route::post('/list/{slug}/save', [ListController::class, 'save']);
    Route::put('/list/{slug}', [ListController::class, 'update']);
    Route::get('/list/{slug}', [ListController::class, 'destroy']);
});

# Only enable the following development-specific routes if we’re *not* running the application in the `production` environment
if (!App::environment('production')) {
    Route::get('/test/login-as/{userId}', [TestController::class, 'loginAs']);
    Route::get('/test/refresh-database', [TestController::class, 'refreshDatabase']);

    # It’s a good idea to move the practice route into this if condition
    # so that our practice routes are not available on production
    Route::any('/practice/{n?}', [PracticeController::class, 'index']);
}