<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\UserController; //UserController.phpによってユーザー画面を表示
use App\Http\Controllers\SearchController; 

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
Route::group(['middleware' => 'auth'], function () {
    // Route::post('answer/{answer}/question_answer',[AnswerController::class,'store'])->name('question_answer');
    // Route::get('/search/search.index', [SearchController::class, 'search.index'])->name('search.index');
    // Route::get('/search/result', [SearchController::class, 'searchresult'])->name('searchresult');
    // Route::get('/question/search', [QuestionController::class, 'search'])->name('search');
    // Route::get('/question/searchresult', [QuestionController::class, 'searchresult'])->name('searchresult');
    // Route::post('question/{question}/addbestanswer', [Bestanswer::class, 'store'])->name('addbestanswer');
    // Route::post('question/{question}/deletebestanswer', [Bestanswer::class, 'destroy'])->name('deletebestanswer');
    Route::post('question/unresolved', [QuestionController::class, 'unresolved'])->name('unresolved');
    Route::post('question/resolved', [QuestionController::class, 'resolved'])->name('resolved');
    Route::get('/', [QuestionController::class, 'index'])
        ->name('question.index');
    Route::post('question/{question}/favorites',[FavoriteController::class, 'store'])->name('favorites');
    Route::post('question/{question}/unfavorites',[FavoriteController::class, 'destroy'])->name('unfavorites');
    Route::get('/question/mypage',[QuestionController::class, 'mydata'])->name('question.mypage');
    Route::post('answer/{answer}/selectbest',[AnswerController::class,'selectbest'])->name('selectbest');
    Route::post('answer/{answer}/delete_bestanswer',[AnswerController::class,'delete_bestanswer'])->name('delete_bestanswer');
    Route::resource('question', QuestionController::class);
    Route::resource('answer', AnswerController::class);
    Route::resource('user', UserController::class);
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
