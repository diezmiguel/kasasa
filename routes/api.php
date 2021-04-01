<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware(['authApi'])->group(function () {
    Route::post(
        '/loan/add',
        [
'uses' => 'LoanController@store', ]
    );
    Route::get(
        '/loan/list',
        [
'uses' => 'LoanController@list', ]
    );
});
