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


/**
 * Protected Api routes
 */

Route::middleware('auth:api')->group(function() {
    
  /**
   * Post routes
   */

  // Route::get('apartements/get', 'Api\ApartementController@get');
  // Route::post('apartement/create', 'Api\ApartementController@store');
  // Route::get('apartement/edit/{apartement}', 'Api\ApartementController@edit');
  // Route::post('apartement/update/{apartement}', 'Api\ApartementController@update');
  // Route::get('apartement/status/{apartement}', 'Api\ApartementController@status');
  // Route::delete('apartement/destroy/{apartement}', 'Api\ApartementController@destroy');

});

/**
 * Auth routes
 */

// Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
//   Route::post('login', 'AuthController@login');
//   Route::post('logout', 'AuthController@logout');
//   Route::post('refresh', 'AuthController@refresh');
//   Route::post('me', 'AuthController@me');
// });

/**
 * Fallback if no route is defined
 */

Route::fallback(function(){
  return response()->json(
    ['message' => 'Page Not Found. If error persists, contact m@marceli.to'],
    404
  );
});

