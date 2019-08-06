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
Route::get('searchresult',[
	'as' => 'searchIndex',
	'uses' => 'HomeController@searchIndex'
]);

Route::get('ajaxsearch',[
	'as' => 'ajaxSearch',
	'uses' => 'HomeController@ajaxSearch'
]);

Route::post('signin',[
	'as' => 'signIn',
	'uses' => 'SignInController@postSignIn'
]);


Route::get('viewtopic/{id}',[
		'as' => 'viewTopic',
		'uses' => 'ViewTopicController@view'
]);

Route::get('aboutus',[
	'as' => 'aboutUs',
	'uses' => 'HomeController@aboutUs'
]);

Route::get('test',function(){
	return \Config::get('constants.options.ItemNumberPerPage');
});

Route::get('personalinfomation/{id}','HomeController@personalInfomation')->name('personalInfomation');

/*Start middleware check sigin*/
Route::middleware(['checkSignIn'])->group(function () {
    Route::prefix('profile')->group(function () {
       	Route::get('information', [
			'as' => 'information',
			'uses' => 'UserController@indexInformation'
		]);

       	Route::post('updateinformation', [
			'as' => 'updateInformation',
			'uses' => 'UserController@updateInformation'
		]);
       	Route::get('changepassword', [
			'as' => 'changePassword',
			'uses' => 'UserController@indexChangePassword'
		]);

		Route::post('changepassword', [
			'as' => 'storeChangePassword',
			'uses' => 'UserController@storeChangePassword'
		]);

		Route::get('managequestion', 'UserController@indexManageQuestion')->name('manageQuestion');
		Route::post('removequestion', 'UserController@removeQuestion')->name('removeQuestion');
		Route::get('manageanswer', 'UserController@indexManageAnswer')->name('manageAnswer');
		Route::post('changeavatar', 'UserController@changeAvatar')->name('changeAvatar');

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

	Route::get('like/{post_id}/{post_type}',[
		'as' => 'like',
		'uses' => 'ViewTopicController@like'
	]);


	Route::get('dislike/{post_id}/{post_type}',[
		'as' => 'dislike',
		'uses' => 'ViewTopicController@dislike'
	]);
	
	Route::get('removenotification/{id}','UserController@removeNotification')->name('removeNotification');

	Route::get('readnotification','UserController@readNotification')->name('readNotification');
});

/*End middleware check sign in*/