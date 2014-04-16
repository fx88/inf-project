<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return Redirect::action('CompanyController@index');
});

Route::get('company', 							'CompanyController@index');
Route::post('company', 							'CompanyController@store');
Route::get('company/create', 					'CompanyController@create');
Route::get('company/{id}', 						'CompanyController@show');
Route::get('company/{id}/edit', 				'CompanyController@edit');
Route::post('company/{id}', 					'CompanyController@update');
Route::get('company/{id}/delete', 				'CompanyController@destroy');

Route::post('company/{id}/rate', 				'CompanyController@storeRate');
Route::get('company/{id}/rate/{rateId}', 		'CompanyController@destroyRate');

Route::get('topic', 							array('before' => 'auth',	'uses'	=>	'TopicController@index'));
Route::get('topic/create', 						array('before' => 'auth',	'uses'	=>	'TopicController@create'));
Route::get('topic/{id}', 						array('before' => 'auth',	'uses'	=>	'TopicController@show'));
Route::post('topic', 							array('before' => 'auth',	'uses'	=>	'TopicController@store'));
Route::get('topic/{id}/edit', 					array('before' => 'auth',	'uses'	=>	'TopicController@edit'));
Route::post('topic/{id}', 						array('before' => 'auth',	'uses'	=>	'TopicController@update'));
Route::get('topic/{id}/delete',					array('before' => 'auth',	'uses'	=>	'TopicController@destroy'));

Route::get('priority', 							array('before' => 'auth',	'uses'	=>	'PriorityController@index'));
Route::get('priority/create', 					array('before' => 'auth',	'uses'	=>	'PriorityController@create'));
Route::get('priority/{id}', 					array('before' => 'auth',	'uses'	=>	'PriorityController@show'));
Route::post('priority', 						array('before' => 'auth',	'uses'	=>	'PriorityController@store'));
Route::get('priority/{id}/edit', 				array('before' => 'auth',	'uses'	=>	'PriorityController@edit'));
Route::post('priority/{id}', 					array('before' => 'auth',	'uses'	=>	'PriorityController@update'));
Route::get('priority/{id}/delete',				array('before' => 'auth',	'uses'	=>	'PriorityController@destroy'));

Route::get('user', 								array('before' => 'auth',	'uses'	=>	'UserController@index'));
Route::get('user/create', 						array('before' => 'auth',	'uses'	=>	'UserController@create'));
Route::get('user/{id}', 						array('before' => 'auth',	'uses'	=>	'UserController@show'));
Route::post('user', 							array('before' => 'auth',	'uses'	=>	'UserController@store'));
Route::get('user/{id}/edit', 					array('before' => 'auth',	'uses'	=>	'UserController@edit'));
Route::post('user/{id}', 						array('before' => 'auth',	'uses'	=>	'UserController@update'));
Route::get('user/{id}/delete', 					array('before' => 'auth',	'uses'	=>	'UserController@destroy'));


Route::get('login', 							'UserController@loginForm');
Route::post('login', 							'UserController@login');
Route::get('logout', 							'UserController@logout');
Route::post('logout', 							'UserController@logout');
