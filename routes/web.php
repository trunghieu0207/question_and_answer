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

Route::post('signin',[
	'as' => 'post-signin',
	'uses' => 'SignInController@postSignIn'
]);

Route::group(['middleware' => 'checkSignIn'], function() {
	Route::get('profile',[
	'as' => 'profile',
	'uses' => 'SignInController@viewtest'
	]);
});

Route::get('logout',[
	'as'=>'log-out',
	'uses' => 'SignInController@logout'
]);

Route::get('test',function(){
	return view('test');
});


Route::get('profile', function() {
	return view('profile');
})->name('profile');

Route::get('viewtopic/{id}',[
	'as' => 'view-topic',
	'uses' => 'ViewTopicController@view'
]);

Route::get('addtopic',[
	'as' => 'add-topic',
	'uses' => 'QuestionController@create'
]);

Route::post('addtopic','QuestionController@store');

Route::get('edittopic/{id}',[
	'as' => 'edit-topic',
	'uses' => 'QuestionController@edit'
]);

Route::post('edittopic/{id}','QuestionController@update');

Route::delete('{id}','QuestionController@destroy');

Route::get('editanswer/{id}',[
	'as' => 'edit-answer',
	'uses' => 'AnswerController@edit'
]);

Route::post('editanswer/{id}','AnswerController@update');

