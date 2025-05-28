<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'api_version' => 'v1',
        'laravel_version' => app()->version(),
        'php_version' => phpversion(),
    ]);
});

Route::webhooks('webhook', 'coinbase', 'post');

