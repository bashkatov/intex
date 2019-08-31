<?php

use Illuminate\Http\Request;
use Illuminate\Routing\RouteGroup;
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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(
    [
//        'middleware' => 'auth:api'
    ], function () {
    Route::get('/markers', 'Api\MarkerController@index')->name('markers.index');
});

Route::fallback(function(){
    return response()->json([
        'message' => 'Page Not Found. If error persists, contact API provider.'], 404);
});
