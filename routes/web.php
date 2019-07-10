<?php

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
//     return view('welcome');
// });

Route::get('/', "TaskController@index")->name('home');
Route::post("/task", "TaskController@store");

Route::get("/task/{id}/edit", "TaskController@edit")->name('task.edit');
Route::patch("/task/{task}", "TaskController@update")->name('task.update');

Route::get("/task/{id}/delete", "TaskController@destroy");

Route::get("/task/{task_id}/tag/{tag_id}", "TaskTagController@link")->name('taskTag.create');
Route::get("/task/{task_id}/tag/{tag_id}/delete", "TaskTagController@destroy")->name('taskTag.delete');

Route::post("/tag", "TagController@store");

Route::get("/tag/{id}/edit", "TagController@edit")->name('tag.edit');
Route::patch("/tag/{tag}", "TagController@update")->name('tag.update');

Route::get('/tag/{id}/delete', "TagController@destroy");

Route::get('/tags', "TagController@index")->name('tags');
