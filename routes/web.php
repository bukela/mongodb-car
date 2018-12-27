<?php

use Illuminate\Support\Facades\DB;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/kola', function () {
    $kola = DB::table('cars')->where('model','101')->get();
    return $kola;
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('add','CarController@create')->name('add.car');
Route::post('add','CarController@store');
Route::get('car','CarController@index');
Route::get('edit/{id}','CarController@edit');
Route::post('edit/{id}','CarController@update');
Route::delete('{id}','CarController@destroy');
