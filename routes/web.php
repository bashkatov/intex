<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/{any}', 'AppController@index')->where('any', '.*');

Route::get('/', function () {
    return view('welcome');
});

Route::group(
    [
        'prefix' => "/",
        'middleware' => \Spatie\HttpLogger\Middlewares\HttpLogger::class
    ], function(){
    Route::get('/', function() {
        return view('welcome');
    });
});
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');



Route::get('/home', 'HomeController@index')->name('home');
