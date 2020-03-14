<?php

Route::get('/', 'HomeController')->name('home');
Route::redirect('/home', '/');

Route::get('/threads', 'ThreadController@index');
Route::get('/thread/{thread}', 'ThreadController@show');
Route::post('/thread/{thread}/replies', 'ReplyController@store');

// Auth routes
Auth::routes([
    'confirm' => false,
    'reset' => false,
    'verify' => false,
]);
