<?php

use App\Message;
use App\Events\MessageSent;
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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Return all messages that will populate our chat messages
Route::get('/getAll', function () {
    $messages = Message::take(200)->pluck('content');
    return $messages;
});

// Allows us to post new message
Route::post('/post', function () {
    $message = new Message();
    $content = request('message');
    $message->content = $content;
    $message->save();

    event(new MessageSent($content));
    return $content;
});

Route::get('/test-broadcast', function(){
    broadcast(new \App\Events\ExampleEvent);
    return view('welcome');
});