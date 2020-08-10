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

Route::get('test', function(){
    return view('test');
});

Route::get('/', 'IndexController@index')->name('index');

Route::get('check', 'DashboardController@index')->name('dashboard');

Route::get('admin', 'AdminController@index')->name('admin');

Route::prefix('admin')->middleware('admin')->group(function(){
    Route::get('contact', 'Admin\SiteContactController@index')->name('admin.contact');
    Route::get('contact/delete/{id}', 'Admin\SiteContactController@delete')->name('admin.contact.delete');
    Route::get('contact/view/{id}', 'Admin\SiteContactController@view')->name('admin.contact.view');
    Route::post('contact/view/{id}', 'Admin\SiteContactController@reply')->name('admin.contact.reply');
    Route::post('contact', 'Admin\SiteContactController@multi')->name('admin.contact.multi');

    Route::prefix('musics')->name('musics')->namespace('Admin')->group(function(){
        Route::get('/', 'MusicController@all')->name('.all');
        Route::get('all', 'MusicController@all')->name('.all');
        Route::get('add', 'MusicController@add')->name('.add');
        Route::post('add/upload', 'MusicController@upload')->name('.add.upload');
        Route::post('add/process', 'MusicController@process')->name('.add.process');
    
        Route::prefix('process')->name('.process')->group(function(){
            Route::post('album', 'MusicProcessController@addAlbum')->name('.album');
            Route::post('artist', 'MusicProcessController@addArtist')->name('.artist');
            Route::post('playlist', 'MusicProcessController@addPlaylist')->name('.playlist');
            Route::post('genre', 'MusicProcessController@addGenre')->name('.genre');
            Route::post('image', 'MusicProcessController@addImage')->name('.image');
        });
    
        Route::get('edit/{id}', 'MusicController@edit')->name('.edit');
        Route::post('edit/{id}', 'MusicController@update')->name('.update');
        Route::post('delete', 'MusicController@deleteMulti')->name('.delete.multi');
        Route::get('delete/{id}', 'MusicController@delete')->name('.delete');
    
        Route::prefix('trash')->name('.trash')->group(function(){
            Route::get('/', 'MusicController@trash');
            Route::get('restore/all', 'MusicController@restoreAll')->name('.restore.all');
            Route::get('restore/{id}', 'MusicController@restore')->name('.restore');
            Route::get('delete/{id}', 'MusicController@trashDelete')->name('.delete');
            Route::get('empty', 'MusicController@empty')->name('.empty');
        });
        
        Route::post('action', 'MusicController@action')->name('.action');
    
    });
    
    Route::prefix('albums')->name('albums')->namespace('Admin')->group(function(){
        Route::get('/', 'AlbumsController@all')->name('.all');
        Route::get('all', 'AlbumsController@all')->name('.all');
        Route::post('add', 'AlbumsController@add')->name('.add');
        Route::post('info', 'AlbumsController@getAlbumInfo')->name('.info');
        Route::post('update', 'AlbumsController@update')->name('.update');
        Route::post('delete', 'AlbumsController@deleteMulti')->name('.delete.multi');
        Route::get('delete/{id}', 'AlbumsController@delete')->name('.delete');
        Route::get('trash', 'AlbumsController@trash')->name('.trash');
        Route::post('trash/action', 'AlbumsController@trashAction')->name('.trash.action');
        Route::get('trash/empty', 'AlbumsController@trashEmpty')->name('.trash.empty');
        Route::get('trash/restore', 'AlbumsController@restore')->name('.trash.restore');
        Route::get('trash/restore/{id}', 'AlbumsController@restoreId')->name('.trash.restore.id');
        Route::get('trash/delete/{id}', 'AlbumsController@trashDelete')->name('.trash.delete');
    });
    
    Route::prefix('artists')->name('artists')->namespace('Admin')->group(function(){
        Route::get('/', 'ArtistsController@all')->name('.all');
        Route::get('all', 'ArtistsController@all')->name('.all');
        Route::post('add', 'ArtistsController@add')->name('.add');
        Route::post('info', 'ArtistsController@singleInfo')->name('.info');
        Route::post('update', 'ArtistsController@update')->name('.update');
        Route::get('delete/{id}', 'ArtistsController@singleDelete')->name('.delete.single');
        Route::post('delete', 'ArtistsController@multiDelete')->name('.delete.multi');
    
        
        Route::get('trash', 'ArtistsController@trash')->name('.trash');
        Route::get('trash/restore/{id}', 'ArtistsController@singleRestore')->name('.trash.restore.single');
        Route::get('trash/delete/{id}', 'ArtistsController@trashSingleDelete')->name('.trash.single.delete');
        Route::get('trash/empty', 'ArtistsController@trashEmpty')->name('.trash.empty');
        Route::get('trash/restore', 'ArtistsController@restore')->name('.trash.restore');
        Route::post('trash/action', 'ArtistsController@trashAction')->name('.trash.action');
    });
    
    Route::prefix('genres')->name('genres')->namespace('Admin')->group(function(){
        Route::get('/', 'GeneresController@all')->name('.all');
        Route::get('all', 'GeneresController@all')->name('.all');
        Route::post('add', 'GeneresController@add')->name('.add');
        Route::post('info', 'GeneresController@singleInfo')->name('.info');
        Route::post('update', 'GeneresController@update')->name('.update');
        Route::get('delete/{id}', 'GeneresController@singleDelete')->name('.delete.single');
        Route::post('delete', 'GeneresController@multiDelete')->name('.delete.multi');
    
        
        Route::get('trash', 'GeneresController@trash')->name('.trash');
        Route::get('trash/restore/{id}', 'GeneresController@singleRestore')->name('.trash.restore.single');
        Route::get('trash/delete/{id}', 'GeneresController@trashSingleDelete')->name('.trash.single.delete');
        Route::get('trash/empty', 'GeneresController@trashEmpty')->name('.trash.empty');
        Route::get('trash/restore', 'GeneresController@restore')->name('.trash.restore');
        Route::post('trash/action', 'GeneresController@trashAction')->name('.trash.action');
    });
    
    Route::prefix('playlists')->name('playlists')->namespace('Admin')->group(function(){
        Route::get('/', 'PlaylistController@all')->name('.all');
        Route::get('all', 'PlaylistController@all')->name('.all');
        Route::post('add', 'PlaylistController@add')->name('.add');
        Route::post('info', 'PlaylistController@singleInfo')->name('.info');
        Route::post('update', 'PlaylistController@update')->name('.update');
        Route::get('delete/{id}', 'PlaylistController@singleDelete')->name('.delete.single');
        Route::post('delete', 'PlaylistController@multiDelete')->name('.delete.multi');
    
        
        Route::get('trash', 'PlaylistController@trash')->name('.trash');
        Route::get('trash/restore/{id}', 'PlaylistController@singleRestore')->name('.trash.restore.single');
        Route::get('trash/delete/{id}', 'PlaylistController@trashSingleDelete')->name('.trash.single.delete');
        Route::get('trash/empty', 'PlaylistController@trashEmpty')->name('.trash.empty');
        Route::get('trash/restore', 'PlaylistController@restore')->name('.trash.restore');
        Route::post('trash/action', 'PlaylistController@trashAction')->name('.trash.action');
    });
    
    Route::prefix('sliders')->name('sliders')->namespace('Admin')->group(function(){
        Route::get('/', 'SlidersController@index');
        Route::get('/add', 'SlidersController@add')->name('.add');
        Route::post('/add', 'SlidersController@insert')->name('.insert');
        Route::get('/edit/{id}', 'SlidersController@edit')->name('.edit');
        Route::post('/edit/{id}', 'SlidersController@update')->name('.update');
        Route::get('/delete/{id}', 'SlidersController@delete')->name('.delete');
    });

    Route::get('content-one', 'Admin\ContentOneController@index')->name('content.one');
    Route::post('content-one', 'Admin\ContentOneController@insert')->name('content.one.insert');

    Route::get('content-two', 'Admin\ContentTwoController@index')->name('content.two');
    Route::post('content-two', 'Admin\ContentTwoController@insert')->name('content.two.insert');

    Route::prefix('settings')->name('settings')->namespace('Admin')->group(function(){
        Route::get('/', 'SettingsController@index');
        Route::post('update', 'SettingsController@update')->name('.update');
        Route::post('contact', 'SettingsController@contact')->name('.contact');
        Route::get('/payment', 'SettingsController@payment')->name('.payment');
        Route::post('/payment', 'SettingsController@paymentAction')->name('.payment.action');
    });

    Route::prefix('users')->name('users')->namespace('Admin')->group(function(){
        Route::get('/', 'UserController@index');
        Route::get('/{id}', 'UserController@delete')->name('.delete');
        Route::get('/admin', 'UserController@admin')->name('.admin');
        Route::get('/admin/add', 'UserController@add')->name('.admin.add');
        Route::post('/admin/add', 'UserController@insert')->name('.admin.insert');
    });

    Route::prefix('newsletter')->name('newsletter')->namespace('Admin')->group(function(){
        Route::get('/', 'NewsletterController@index');
        Route::get('/view', 'NewsletterController@view')->name('.view');
        Route::get('/send', 'NewsletterController@send')->name('.send');
        Route::get('/history', 'NewsletterController@history')->name('.history');
    });
});

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
