<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use App\Article;
use App\Comment;
Route::get('welcome_v', function () {
    $laravel = app();
    return view('welcome_i', ['laravel'=>$laravel]);
});
Route::get('version', function()
{
    $laravel = app();
    return "Your Laravel version is ".$laravel::VERSION;
});
Route::get('test','TestController@index');
Route::get('/','IndexController@index')->name('/');
Route::get('searchForm','SearchController@searchForm')->name('searchForm');
Route::get('search/{field}/{searchText}','SearchController@search')->name('search');
Route::get('/admin','AdminController@index')->name('admin');
Route::get('/admin/user','AdminController@indexUser')->name('admin/user');
Route::get('article/{id}/{page}/{step?}','IndexController@show')->name('articleShow');
Route::get('articleFound/{id}/{field}/{searchText}/{page}/{step?}','SearchController@show')->name('articleFoundShow');
Route::get('admin/article/{id}/{page}/{step?}','AdminController@show')->name('articleAdmin');
Route::get('admin/add','AdminController@add')->name('articleAdd');
Route::get('page/update/{id}/{page}','AdminController@update')->name('articleUpdate');
Route::get('image/add/{id}/{page}','AdminController@imageAdd')->name('imageAdd');
Route::get('moderation','ModerController@showComments')->middleware('auth')->name('moderation');

//POST request
Route::post('searchDetails','SearchController@searchDetails')->name('searchDetails');
Route::post('page/store','AdminController@store')->name('articleStore');
Route::post('page/update/store/{id}/{page}','AdminController@updateStore')->name('updateStore');
Route::post('ajaxComment','Ajax\CommentController@comment')->middleware('auth');
Route::post('comment/confirmation','ModerController@confirmationComments')->name('confirmationComments');
Route::post('image/store/{id}/{page}','AdminController@imageStore')->name('imageStore');

Route::get('delete/{article}','AdminController@deleteArticle')->name('articleDelete');
Route::get('user/delete/{user}','AdminController@deleteUser')->name('userDelete');
Route::get('comment/delete/{comment}/{article_id}/{page}','AdminController@deleteComment')->name('commentDelete');
// Authentication Routes...
Route::auth();

// Маршруты аутентификации...
Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\MyAuth@auth');

// Маршруты регистрации...
Route::get('register', 'Auth\AuthController@getRegister');
Route::post('register','AdvancedReg@register');
Route::get('register/confirm/{token}','AdvancedReg@confirm');
Route::get('repeat_confirm','AdvancedReg@getRepeat');
Route::post('repeat_confirm','AdvancedReg@postRepeat');


Route::get('/home', 'HomeController@index');
