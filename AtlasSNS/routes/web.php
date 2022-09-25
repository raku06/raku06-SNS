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
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();


//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login'); // ログインページ表示
Route::post('/login', 'Auth\LoginController@login'); // ログイン機能の処理

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

// Route::post('/register', 'Auth\RegisterController@session');

Route::get('/added', 'Auth\RegisterController@added');
Route::post('/added', 'Auth\RegisterController@added');



//ログイン中のページ
Route::get('/top','PostsController@index');

Route::get('/top','PostsController@posts'); // 投稿画面の表示のためのルーティング

Route::post('/posts','PostsController@store'); // 投稿処理

Route::get('/profile','UsersController@profile');

Route::get('/search','UsersController@search');
Route::post('/search','UsersController@index'); // 検索機能

Route::get('/follow-list','PostsController@follow');
Route::get('/follower-list','PostsController@follower');

Route::get('/logout', 'Auth\LoginController@logout');

Route::post('/top/update', 'PostsController@update');

Route::get('/top/{id}/delete', 'PostsController@delete');


// フォロー機能の実装

// ログイン状態
Route::group(['middleware' => 'auth'], function() {

    // ユーザー関連
    Route::resource('users', 'UsersController', ['only' => ['index', 'show', 'edit', 'update']]);

    // フォロー
    Route::post('users/{user}/follow', 'UsersController@follow')->name('follow'); // name()を使うと、ルート名（括弧内につけた名前）を指定することでURLを呼び出すことができる。
    // （コントローラーやビューの中でURLを呼び出す時に直にパスを書かなくてよくなる。

    // フォロー解除
    Route::delete('users/{user}/unfollow', 'UsersController@unfollow')->name('unfollow');

});

// group(['middleware' => 'auth'], function() {
//     {}に書かれたものは全てミドルウェアが適用される
// });

// --------------------------
// ミドルウェアとは、指定したアドレスにリクエストを送ると自動で処理を行う仕組みのこと

// 処理が行わられるタイミングは以下の2つの場合
// ① ビューからコントローラーにアクセスした時
// ② コントローラーからビューにレスポンスを送る時
// --------------------------
