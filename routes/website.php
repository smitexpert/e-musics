<?php

Route::prefix('song')->namespace('Website')->group(function(){
    Route::get('{slug}', 'SongsController@index')->name('song');
    Route::post('{slug}', 'SongsController@comment')->name('song.comment');
    Route::get('{slug}/download', 'SongsController@download')->name('download');
});

Route::prefix('browse')->name('browse')->namespace('Website')->group(function(){
    Route::get('/', 'SongsController@browse')->name('');
    Route::get('new', 'SongsController@new')->name('.new');
});

Route::prefix('album')->name('album')->namespace('Website')->group(function(){
    Route::get('/', 'AlbumController@index');
    Route::get('/{slug}', 'AlbumController@album')->name('.album');
    Route::get('/{slug}/{music?}', 'AlbumController@single')->name('.single');
});

Route::prefix('artist')->name('artist')->namespace('Website')->group(function(){
    Route::get('/', 'ArtistController@index');
    Route::get('/{slug}', 'ArtistController@artist')->name('.artist');
    Route::get('/{slug}/{music?}', 'ArtistController@single')->name('.single');
});

Route::prefix('genre')->name('genre')->namespace('Website')->group(function(){
    Route::get('/', 'GenresController@index');
    Route::get('/{slug}', 'GenresController@genre')->name('.genre');
    Route::get('/{slug}/{music?}', 'GenresController@single')->name('.single');
});

Route::prefix('account')->name('account')->namespace('Website')->group(function(){
    Route::get('/', 'AccountController@index');
    Route::post('/info', 'AccountController@info')->name('.info');
    Route::post('/update', 'AccountController@update')->name('.update');
});

Route::get('contact-us', 'ContactController@index')->name('contact');
Route::post('contact-us', 'ContactController@insert')->name('contact.insert');