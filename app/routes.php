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
    ######################### RUTAS COMUNES ######################
    Route::get('/', ['as' => 'home', 'uses' => 'UsersController@home']);
    Route::get('/patients', ['as' => 'patient', 'uses' => 'PatientsController@index']);
    Route::get('/therapists', ['as' => 'therapist', 'uses' => 'TherapistsController@index']);
    Route::get('therapist/calendar/add', ['uses' => 'ScheduleController@TherapistCreate']);
    Route::get('/calendar', ['as' => 'calendar', 'uses' => 'CalendarController@index']);
    Route::get('/calendar/add', ['as' => 'addSchedule', 'uses' => 'ScheduleController@create']);
    Route::get('/calendar/therapist', 'CalendarController@byTherapist');
    Route::get('/my/calendar', 'TherapistsController@calendar');
    Route::get('/my/durations', 'TherapistsController@durations');
    Route::get('/rooms', ['as' => 'room', 'uses' => 'RoomsController@index']);
    Route::get('/admin','AdminsController@index');
    Route::get('/room/list','RoomsController@show');
    Route::get('/therapists/config','TherapistsController@configDuracion');

    ########################### RUTAS AJAX ########################

    Route::post('/calendar/hours', 'CalendarController@show');

    Route::post('/schedule/create','ScheduleController@save');
    Route::post('/schedule/show','ScheduleController@show');
    Route::post('/schedule/delete','ScheduleController@destroy');
    Route::post('/schedule/confirm','ScheduleController@confirm');
    Route::post('/schedule/pending','ScheduleController@pending');

    Route::post('/therapist/list','TherapistsController@showList');
    Route::post('/therapist/show/{id}','TherapistsController@show');
    Route::post('/therapist/save','TherapistsController@update');
    Route::post('/therapist/create','TherapistsController@create');
    Route::post('/therapist/delete/{id}','TherapistsController@destroy');

    Route::post('/patient/list','PatientsController@showList');
    Route::post('/patient/show/{id}','PatientsController@show');
    Route::post('/patient/save','PatientsController@update');
    Route::post('/patient/create','PatientsController@create');
    Route::post('/patient/delete/{id}','PatientsController@destroy');

    Route::post('/therapist/duration','TherapistsController@duration');
    Route::post('/therapist/duration/new','TherapistsController@durationNew');
    Route::post('/therapist/duration/save','TherapistsController@durationSave');
    Route::post('/therapist/duration/delete','TherapistsController@durationDelete');
    Route::post('/therapist/color','TherapistsController@color');
    Route::post('/therapist/access','TherapistsController@access');

    Route::post('/duration/new','DurationsController@create');
});



