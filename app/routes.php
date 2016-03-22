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
    Route::get('/history', ['as' => 'history', 'uses' => 'UsersController@history']);
    Route::get('/profile', ['as' => 'profile', 'uses' => 'UsersController@profile']);
    Route::get('/config', ['as' => 'config', 'uses' => 'UsersController@config']);
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
    Route::get('/print/room/{time}','RoomsController@printer');
    Route::get('/therapists/config','TherapistsController@configDuracion');

    Route::get('/finance','FinanceController@index');
    Route::get('/finance/income','FinanceController@income');
    Route::get('/finance/expenses','FinanceController@expenses');
    Route::get('/finance/therapists','FinanceController@therapists');
    Route::get('/finance/voucher','FinanceController@voucher');
    Route::get('/finance/patients','FinanceController@patients');

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
    Route::post('/patient/exist','PatientsController@exist');
    Route::post('/patient/debt','PatientsController@debt');

    Route::post('/therapist/duration','TherapistsController@duration');
    Route::post('/therapist/duration/new','TherapistsController@durationNew');
    Route::post('/therapist/duration/save','TherapistsController@durationSave');
    Route::post('/therapist/duration/delete','TherapistsController@durationDelete');
    Route::post('/therapist/color','TherapistsController@color');
    Route::post('/therapist/access','TherapistsController@access');
    Route::post('/therapist/exist','TherapistsController@exist');

    Route::post('/duration/new','DurationsController@create');
    Route::post('/rooms/update/therapist','RoomsController@update');

    Route::post('/payment/show','PaymentsController@show');

    Route::post('/finance/therapist/pay','FinanceController@payTherapist');
});



