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

Route::get('signup','SignUpController@index')->name('signUp');
Route::post('signup','SignUpController@store')->name('signUpStore');
Route::get('validEmail','SignUpController@validEmail')->name('validEmail');

Route::get('signin',[
	'as' => 'sign-in',
	'uses' => 'SignInController@view'
]);
Route::get('submitSearch',[
	'as' => 'submitSearch',
	'uses' => 'HomeController@submitSearch'
]);

Route::get('search',[
	'as' => 'search',
	'uses' => 'HomeController@search'
]);

Route::post('signin',[
	'as' => 'post-signin',
	'uses' => 'SignInController@postSignIn'
]);

Route::get('profile', function() {
	return redirect()->route('sign-in');
});

Route::get('viewtopic/{id}',[
		'as' => 'view-topic',
		'uses' => 'ViewTopicController@view'
]);

Route::get('viewtopic', function() {
	return redirect()->route('sign-in');
});

Route::get('edittopic', function() {
	return redirect()->route('signIn');
});

/*Start middleware check sigin*/
Route::middleware(['checkSignIn'])->group(function () {
    Route::prefix('profile')->group(function () {
       	Route::get('information', [
			'as' => 'information',
			'uses' => 'ProfileController@getInformation'
		]);

       	Route::post('postInformation', [
			'as' => 'post-information',
			'uses' => 'ProfileController@postInformation'
		]);
       	Route::get('changepassword', [
			'as' => 'change-password',
			'uses' => 'ProfileController@getChangepassword'
		]);

		Route::post('postchangepassword', [
			'as' => 'postchange-password',
			'uses' => 'ProfileController@postChangepassword'
		]);

		Route::get('manage_question', 'ProfileController@indexManageQuestion')->name('manageQuestion');
		Route::get('manage_answer', 'ProfileController@indexManageAnswer')->name('manageAnswer');
		Route::post('remove_question', 'ProfileController@removeQuestion')->name('removeQuestion');
		Route::post('change_avatar', 'ProfileController@changeAvatar')->name('changeAvatar');

    });


    Route::get('logout',[
		'as'=>'log-out',
		'uses' => 'SignInController@logout'
	]);

	

	Route::get('addtopic',[
		'as' => 'addTopic',
		'uses' => 'QuestionController@create'
	]);

	Route::post('addtopic','QuestionController@store');


	Route::get('edittopic/{id}',[
		'as' => 'editTopic',
		'uses' => 'QuestionController@edit'
	]);


	Route::post('edittopic','QuestionController@update');

	Route::post('deletetopic','QuestionController@destroy')->name('deleteTopic');

	Route::get('editanswer/{id}',[
		'as' => 'editAnswer',
		'uses' => 'AnswerController@edit'
	]);


	Route::post('editanswer','AnswerController@update');

	Route::post('addanswer','AnswerController@store')->name('addAnswer');

	Route::get('bestanswer/{id}',[
		'as' => 'best-answer',
		'uses' => 'ViewTopicController@bestAnswer'
	]);

	Route::get('removebestanswer/{id}',[
		'as' => 'remove-best-answer',
		'uses' => 'ViewTopicController@removeBestAnswer'
	]);

	Route::get('like/{post_id}/{post_type}/{user_id}',[
		'as' => 'like',
		'uses' => 'ViewTopicController@like'
	]);
	Route::get('checklike/{post_id}/{post_type}/{user_id}',[
		'as' => 'check-like',
		'uses' => 'ViewTopicController@checkLike'
	]);


	Route::get('dislike/{post_id}/{post_type}/{user_id}',[
		'as' => 'dislike',
		'uses' => 'ViewTopicController@dislike'
	]);


});

/*End middleware check sign in*/

