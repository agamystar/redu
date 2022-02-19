<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PinController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/gen_pin',[PinController::class,'getPinCodes']);
