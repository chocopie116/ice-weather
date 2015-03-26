<?php

Route::get('/', function()
{
    return View::make('top');
});

Route::get('/capture', function()
{
    return View::make('capture');
});
