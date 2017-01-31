<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

// $app->get('/', function () use ($app) {
//     return $app->version();
// });

$app->group(
	[
		'prefix' => 'api/user',
		'middleware' => 'cors'
	], 
	function () use ($app) {
	    $app->get('/list', 'UserInfoController@index');
	    $app->get('/{iUserID}', 'UserInfoController@getUser');
	    $app->delete('/{iUserID}', 'UserInfoController@delUser');
	    $app->post('/add', 'UserInfoController@addUser');
	    $app->put('/{iUserID}', 'UserInfoController@updateUser');
	});

$app->group(
	[
		'prefix' => 'api/event/list',
		'middleware' => 'cors'
	], 
	function () use ($app) {
	    $app->get('/{iStatus}', 'EventListController@getListByStatus');
	    $app->get('/date?start={dStart}&end={dEnd}', 'EventListController@getListByDate');
	});