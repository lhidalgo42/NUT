<?php

/*
|--------------------------------------------------------------------------
| Routes for Login
|--------------------------------------------------------------------------
|
*/
Route::get('/login', ['as' => 'login', 'uses' => 'SessionsController@create']);
Route::get('/logout', ['as' => 'logout', 'uses' => 'SessionsController@destroy']);
Route::resource('sessions', 'SessionsController', ['only' => ['create', 'store', 'destroy']]);

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
|
*/
Route::group(array('before' => 'auth'), function() {
    Route::get('/', ['as' => 'home', 'uses' => 'UsersController@home']);
    Route::get('/patients', ['as' => 'patient', 'uses' => 'PatientsController@index']);
    Route::get('/therapists', ['as' => 'therapist', 'uses' => 'TherapistsController@index']);
    Route::get('/calendar', ['as' => 'calendar', 'uses' => 'CalendarController@index']);
    Route::get('/calendar/add', ['as' => 'addSchedule', 'uses' => 'ScheduleController@create']);
    Route::post('/calendar/hours', 'CalendarController@show');
    Route::get('/rooms', ['as' => 'room', 'uses' => 'RoomsController@index']);
    Route::post('/schedule/create','ScheduleController@create');
    Route::get('/room/list','RoomsController@show');
    Route::get('/patient/list','PatientsController@show');
    Route::get('/therapist/list','TherapistsController@show');
});



