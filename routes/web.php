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

Route::get('/', function () {
    return redirect('config');
});

Route::get('/heartbeat', function () {
    return response('', 200);
});

Route::get('config', 'ConfigController@index');
Route::post('config', 'ConfigController@store');
Route::delete('config', 'ConfigController@destroy');

Route::group(['middleware' => 'noapi'], function () {
    Route::get('matches', 'MatchesController@index');
    Route::post('matches', 'MatchesController@store');
    Route::get('matches/create', 'MatchesController@create');
    Route::get('matches/{id}', 'MatchesController@show');
    Route::delete('matches/{id}', 'MatchesController@destroy');
    
    Route::get('games', 'GamesController@index');
    Route::get('games/{id}', 'GamesController@show');
});
