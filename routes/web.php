<?php

Route::get('/', 'HomeController')->name('home');
Route::redirect('/home', '/');

Route::get('/threads', 'ThreadController@index')->name('threads.index');
Route::get('/threads/create', 'ThreadController@create')->name('threads.create');
Route::get('/threads/{channel}/{thread}', 'ThreadController@show')->name('threads.show');
Route::post('threads', 'ThreadController@store')->name('threads.store');
Route::post('/threads/{channel}/{thread}/replies', 'ReplyController@store')->name('replies.store');

// Auth routes
Auth::routes([
    'confirm' => false,
    'reset' => false,
    'verify' => false,
]);
