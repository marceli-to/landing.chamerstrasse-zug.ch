<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

/**
 * Admin routes
 */

// Route::view('admin', 'backend.app');
// Route::get('admin/{any}', function () {
// 	return view('backend.app');
// })->where('any', '.*');

// Landing routes
Route::post('/subscribe', 'SubscriberController@store')->name('page_landing_subscribe');
Route::get('/datenschutz', 'PageController@privacy')->name('page_privacy');
Route::get('/impressum', 'PageController@imprint')->name('page_imprint');
Route::get('/{state?}', 'PageController@landing')->name('page_landing');



