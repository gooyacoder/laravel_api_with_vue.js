<?php


Auth::routes();

Route::get('/{any}', 'AppController@index')->where('any', '.*');
