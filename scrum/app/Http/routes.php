<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

//	Route::get('/', function () {
//		return view('welcome');
//	});

Route::group(['middleware' => ['web']], function () {

	Route::get('/','DashboardController@index' )->middleware('auth');

    Route::get('/admin', 'AdminController@index');
    Route::get('/admin/attributes', 'AdminController@view');
    Route::post('/admin/attributes', 'AdminController@addOption');

	Route::get('/projects', 'ProjectController@index');
    Route::get('/project/{project}', 'ProjectController@view');
	Route::get('/project/edit/{project}', 'ProjectController@edit');
    Route::post('/project/update/{project}', 'ProjectController@update');
    Route::post('/project', 'ProjectController@create');
    Route::delete('/project/{project}', 'ProjectController@delete');

	//Route::get('/tickets', 'TicketController@index');
    Route::get('/tickets/{project}', 'TicketController@index');
	Route::get('/tickets', 'TicketController@myTickets');
	Route::get('/ticket/{ticket}', 'TicketController@view');
    Route::get('/ticket/new/{project}', 'TicketController@newAction');
	Route::post('/ticket', 'TicketController@create');
	Route::post('/ticket/update/{ticket}', 'TicketController@update');
    Route::post('/ticket/status', 'TicketController@changeStatus');
	Route::delete('/ticket/{ticket}/{project}', 'TicketController@delete');

    Route::get('/scrum/{project}', 'ScrumController@index');

	Route::auth();
});
