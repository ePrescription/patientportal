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


Route::get('/login', function () {
    return view('portal.login');
});

Route::group(['prefix' => 'user'], function()
{
    Route::group(['namespace' => 'User'], function()
    {
        Route::get('rest/users', array('as' => 'user.users', 'uses' => 'UserController@getUsers'));
        //Route::get('rest/api/{patientId}/profile', array('as' => 'patient.profile', 'uses' => 'CommonController@getPatientProfile'));
    });

});

Route::get('/logout', function()
{
    Auth::logout();
    Session::flush();
    return Redirect::to('/');
});

Event::listen('illuminate.query', function($query)
{
    var_dump($query);
});