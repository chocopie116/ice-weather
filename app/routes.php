<?php

Route::get('/', function()
{
    return View::make('top');
});

Route::get('/capture', function()
{
    return View::make('capture');
});

Route::get('/report', function()
{
    return View::make('report');
});

Route::get('/api/{target}/image', 'ApiController@getImage');
Route::post('/api/{target}/image', 'ApiController@postImage');

App::missing(function ($exception) {
    return Response::make('ページがみつかりません', 404);
});
