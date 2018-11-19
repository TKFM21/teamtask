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

Route::get('/', 'TasksController@index');

// Auth::routes();
// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

//送信メール本文のプレビュー

Route::get('sample/mailable/preview', function (){
    return new App\Mail\SampleNotification();
});

// サンプルメール送信テスト
Route::get('sample/mailable/send', 'SampleController@SampleNotification');

// システム管理者のみ
Route::group(['middleware' => ['auth', 'can:system-only']], function () {
    //
});

// 管理者以上
Route::group(['middleware' => ['auth', 'can:admin-higher']], function () {
    
    // ユーザー編集
    // Route::get('users/edit/{user_id}', 'UsersController@edit')->name('users.edit');
    // Route::post('users/edit/{user_id}', 'UsersController@update')->name('users.update');
    
    // ユーザー削除
    Route::post('users/delete/{user_id}', 'UsersController@delete')->name('users.destroy');
    
    // Registration Routes...
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');

});

// CRUD以上
Route::group(['middleware' => ['auth', 'can:crud-higher']], function () {
    Route::delete('delete/{task}', 'TasksController@destroy')->name('tasks.delete');
});

// CRU以上
Route::group(['middleware' => ['auth', 'can:cru-higher']], function () {
    //Route::get('tasks/create', 'TasksController@create')->name('tasks.create');
    Route::resource('tasks', 'TasksController', ['only' => ['create', 'store']]);
});

// RU以上
Route::group(['middleware' => ['auth', 'can:ru-higher']], function () {
    Route::get('edit/{task}', 'TasksController@edit')->name('tasks.edit');
    Route::put('edit/{task}', 'TasksController@update')->name('tasks.update');
});

// 全ユーザー
Route::group(['middleware' => ['auth', 'can:r-higher']], function () {
    // ユーザー一覧
    Route::resource('users', 'UsersController', ['only' => ['index', 'show']]);
    Route::get('users/edit/{user_id}', 'UsersController@edit')->name('users.edit');
    Route::put('users/edit/{user_id}', 'UsersController@update')->name('users.update');
    Route::get('tasks/{task}', 'TasksController@show')->name('tasks.show');
    //Route::resource('tasks', 'TasksController', ['only' => ['show']]);
    Route::get('taskhistories/index', 'TaskhistoriesController@index')->name('taskhistories.index');
    Route::get('taskhistories/{taskhistory}', 'TaskhistoriesController@show')->name('taskhistories.show');
});
