<?php

Route::get('/', 'HomeController')->name('home');
Route::redirect('/home', '/');

Route::resource('threads', 'ThreadController')->except(['edit', 'update', 'destroy']);
Route::post('/thread/{thread}/replies', 'ReplyController@store')->name('replies.store');

// Auth routes
Auth::routes([
    'confirm' => false,
    'reset' => false,
    'verify' => false,
]);
