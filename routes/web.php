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

Route::get('/','HomeController@index')->name('home-page');

Route::get('signup','SignUpController@getSignUp')->name('getSignUp');
Route::post('signup','SignUpController@postSignUp')->name('postSignUp');
Route::get('validEmail','SignUpController@validEmail')->name('validEmail');

Route::get('signin',[
	'as' => 'sign-in',
	'uses' => 'SignInController@view'
]);

Route::get('search',[
	'as' => 'search',
	'uses' => 'HomeController@search'
]);

Route::post('signin',[
	'as' => 'post-signin',
	'uses' => 'SignInController@postSignIn'
]);

Route::group(['middleware' => 'checkSignIn'], function() {
	Route::get('logout',[
		'as'=>'log-out',
		'uses' => 'SignInController@logout'
	]);
	Route::get('profile', function() {
		return 'not code yet!';
	})->name('profile');
	Route::get('profile/manage_question', 'ProfileController@index_manage_question')->name('manage_question');
	Route::get('profile/manage_answer', 'ProfileController@index_manage_answer')->name('manage_answer');
	Route::post('profile/remove_question', 'ProfileController@remove_question')->name('remove_question');
	Route::post('profile/change_avatar', 'ProfileController@change_avatar')->name('change_avatar');
});

Route::get('search_test',[
	'as' => 'search_test',
	'uses' => 'HomeController@search_test'
]);

Route::get('test',function(){
	return view('test');
});

Route::get('profile', function() {
	return view('information');
});

Route::get('changepassword', function() {
	return view('changepassword');
});

