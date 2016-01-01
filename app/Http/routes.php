<?php

Route::get('/', 'RecordController@index');
Route::post('/', 'RecordController@store');
Route::get('/{record_id}/{token}', 'RecordController@destroy');