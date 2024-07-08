<?php

use App\DesignPatterns\SpecificationPattern\Item;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

Route::get('/test', function () {
    return "Sign URL";
})->name('test')->middleware('signed');

Route::get('/', function () {

    $signedUrl = URL::signedRoute('test', [],  now()->addSeconds(1));
    echo "<a href='{$signedUrl}'>Signed URL</a>";

});

Route::get('/md5', function () {
    return md5(time());
});

Route::get('/item', function () {

    $item = new Item(2.1);

    dd($item);

});




