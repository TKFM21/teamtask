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

Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();
// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/home', 'HomeController@index')->name('home');

//送信メール本文のプレビュー

Route::get('sample/mailable/preview', function (){
    return new App\Mail\SampleNotification();
});

// サンプルメール送信テスト
Route::get('sample/mailable/send', 'SampleController@SampleNotification');

// 全ユーザー
Route::group(['middleware' => ['auth', 'can:r-higher']], function () {
    // ユーザー一覧
    Route::get('/account', 'AccountController@index')->name('account.index');
});

// 管理者以上
Route::group(['middleware' => ['auth', 'can:admin-higher']], function () {
    // ユーザー登録
    Route::get('/account/regist', 'AccountController@regist')->name('account.regist');
    Route::post('/account/regist', 'AccountController@createData')->name('account.regist');

    // ユーザー編集
    Route::get('/account/edit/{user_id}', 'AccountController@edit')->name('account.edit');
    Route::post('/account/edit/{user_id}', 'AccountController@updateData')->name('account.edit');
    
    // ユーザー削除
    Route::post('/account/delete/{user_id}', 'AccountController@deleteData');
    
    // Registration Routes...
    $this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    $this->post('register', 'Auth\RegisterController@register');

});

// システム管理者のみ
Route::group(['middleware' => ['auth', 'can:system-only']], function () {
    //
});
