<?php

use App\DesignPatterns\SpecificationPattern\Item;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

Route::get('/Test', function () {
    return "Sign URL";
})->name('Test')->middleware('signed');

Route::get('/', function () {

    $signedUrl = URL::signedRoute('Test', [],  now()->addSeconds(1));
    echo "<a href='{$signedUrl}'>Signed URL</a>";

});

Route::get('/md5', function () {
    return md5(time());
});

Route::get('/item', function () {

    $item = new Item(2.1);

    dd($item);

});




