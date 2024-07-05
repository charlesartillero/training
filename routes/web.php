<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    $user = \App\Models\User::first();

    \App\Jobs\SampleJob::dispatch($user);

    return 'Done';
});
