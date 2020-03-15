<?php

Route::get('/', 'HomeController')->name('home');
Route::redirect('/home', '/');

Route::get('/threads', 'ThreadController@index')->name('threads.index');
Route::post('/threads', 'ThreadController@store')->name('threads.store');
Route::get('/thread/{thread}', 'ThreadController@show')->name('threads.show');
Route::post('/thread/{thread}/replies', 'ReplyController@store')->name('replies.store');

// Auth routes
Auth::routes([
    'confirm' => false,
    'reset' => false,
    'verify' => false,
]);
