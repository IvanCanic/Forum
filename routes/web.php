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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/forum', 'ForumController@index')->name('forum');
Route::get('/forum/create', 'ForumController@create')->name('create-forum')->middleware('auth');
Route::post('/forum', 'ForumController@store')->name('store-forum')->middleware('auth');
Route::get('/forum/{id}', 'ForumController@show')->name('show-forum');
Route::get('/forum/{id}/edit', 'ForumController@edit')->name('edit-forum')->middleware('auth');
Route::patch('/forum/{id}', 'ForumController@update')->name('update-forum')->middleware('auth');
Route::delete('/forum/{id}', 'ForumController@destroy')->name('delete-forum')->middleware('auth');

Route::get('/section-{forumId}/create', 'SectionController@create')->name('create-section')->middleware('auth');
Route::post('/section', 'SectionController@store')->name('store-section')->middleware('auth');
Route::get('/section/{id}', 'SectionController@show')->name('show-section');
Route::get('/section/{id}/edit', 'SectionController@edit')->name('edit-section')->middleware('auth');
Route::patch('/section/{id}', 'SectionController@update')->name('update-section')->middleware('auth');
Route::delete('/section/{id}', 'SectionController@destroy')->name('delete-section')->middleware('auth');

Route::get('/thread-{sectionId}/create', 'ThreadController@create')->name('create-thread')->middleware('auth');
Route::post('/thread','ThreadController@store')->name('store-thread')->middleware('auth');
Route::get('/thread/{id}', 'ThreadController@show')->name('show-thread');
Route::get('thread/{id}/edit', 'ThreadController@edit')->name('edit-thread')->middleware('auth');
Route::patch('/thread/{id}', 'ThreadController@update')->name('update-thread')->middleware('auth');
Route::delete('/thread/{id}', 'ThreadController@destroy')->name('delete-thread')->middleware('auth');

Route::post('/reply', 'ReplyController@store')->name('store-reply')->middleware('auth');
Route::get('/reply/{id}/edit', 'ReplyController@edit')->name('edit-reply')->middleware('auth');
Route::patch('/reply/{id}', 'ReplyController@update')->name('update-reply')->middleware('auth');
Route::delete('/reply/{id}', 'ReplyController@destroy')->name('delete-reply')->middleware('auth');

Route::get('profile/{id}', 'ProfileController@show')->name('show-profile');
Route::get('profile/{id}/edit','ProfileController@edit')->name('edit-profile')->middleware('auth');
Route::patch('profile/{id}', 'ProfileController@update')->name('update-profile')->middleware('auth');
