<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
  return $request->user();
});

Route::group(['middleware' => ['cors', 'guest:api']], function () {
  Route::post('login', 'Auth\LoginController@apiLogin');
  Route::post('register', 'Auth\RegisterController@register');

  Route::post('auth/social/facebook', 'Api\SocialLoginController@loginFacebook');
});

Route::group(['middleware' => ['api', 'cors', 'auth:api']], function ($router) {

  Route::get('matches/list', 'Api\MatchesController@list');
  Route::get('predictions/list', 'Api\PredictionsController@list');
  Route::put('predictions/{predictions}', 'Api\PredictionsController@update');
  Route::get('leaderboard', 'Api\LeaderboardsController@index');
  Route::get('settings', 'Api\SettingsController@index');
  Route::post('settings', 'Api\SettingsController@update');

});
