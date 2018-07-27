<?php


Route::get('/', 'TeknasyonController@index');
Route::get('/login', 'TeknasyonController@login');
Route::post('signin', 'TeknasyonController@signin');
Route::get('/logout', 'TeknasyonController@logout');


Route::get('/users', 'UserController@index');
Route::post('/users', 'UserController@user_insert');
Route::post('/users/{id}', 'UserController@user_update');

Route::get('/languages', 'LanguagesController@index');

Route::get('/versions', 'VersionController@index');
Route::post('/versions', 'VersionController@version_insert');
Route::post('/versions/{id}', 'VersionController@version_update');

Route::get('/projects', 'ProjectsController@index');
Route::post('/projects', 'ProjectsController@projects_insert');
Route::post('/projects/{id}', 'ProjectsController@projects_update');

Route::get('/projects/{slug}/lang/{slug2}', 'ProjectsController@languages');
Route::post('/languages_insert', 'ProjectsController@languages_insert');
Route::post('/languages_update/{id}', 'ProjectsController@languages_update');