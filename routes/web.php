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

Route::get('/','HomeController@index')->name('homePage');

Route::get('signup','SignUpController@index')->name('signUp');
Route::post('signup','SignUpController@store')->name('signUpStore');
Route::get('validEmail','SignUpController@validEmail')->name('validEmail');

Route::get('signin',[
	'as' => 'signInIndex',
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
	'as' => 'signIn',
	'uses' => 'SignInController@postSignIn'
]);


Route::get('viewtopic/{id}',[
		'as' => 'viewTopic',
		'uses' => 'ViewTopicController@view'
]);


/*Start middleware check sigin*/
Route::middleware(['checkSignIn'])->group(function () {
    Route::prefix('profile')->group(function () {
       	Route::get('information', [
			'as' => 'information',
			'uses' => 'ProfileController@indexInformation'
		]);

       	Route::post('updateinformation', [
			'as' => 'updateInformation',
			'uses' => 'ProfileController@updateInformation'
		]);
       	Route::get('changepassword', [
			'as' => 'changePassword',
			'uses' => 'ProfileController@indexChangePassword'
		]);

		Route::post('changepassword', [
			'as' => 'storeChangePassword',
			'uses' => 'ProfileController@storeChangePassword'
		]);

		Route::get('managequestion', 'ProfileController@indexManageQuestion')->name('manageQuestion');
		Route::get('manageanswer', 'ProfileController@indexManageAnswer')->name('manageAnswer');
		Route::post('removequestion', 'ProfileController@removeQuestion')->name('removeQuestion');
		Route::post('changeavatar', 'ProfileController@changeAvatar')->name('changeAvatar');

    });


    Route::get('logout',[
		'as'=>'logOut',
		'uses' => 'SignInController@logOut'
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
		'as' => 'bestAnswer',
		'uses' => 'ViewTopicController@bestAnswer'
	]);

	Route::get('removebestanswer/{id}',[
		'as' => 'removeBestAnswer',
		'uses' => 'ViewTopicController@removeBestAnswer'
	]);

	Route::get('like/{post_id}/{post_type}/{user_id}',[
		'as' => 'like',
		'uses' => 'ViewTopicController@like'
	]);


	Route::get('dislike/{post_id}/{post_type}/{user_id}',[
		'as' => 'dislike',
		'uses' => 'ViewTopicController@dislike'
	]);


});

/*End middleware check sign in*/

