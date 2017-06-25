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
Route::get('/getlines', function () {
    return URL::asset('resources/getlines.json');
});


Route::get('/modelo1', function () {
    return view('disenos/modelo1');
});

Route::get('/modelo2', function () {
    return view('disenos/modelo2');
});

Route::get('/modelo3', function () {
    return view('disenos/modelo3');
});

Route::get('/modelo4', function () {
    return view('disenos/modelo4');
});






Route::get('/', function () {
    return view('home');
});
Route::get('/prueba', function () {
    return view('prueba');
});
Route::get('/prueba1', function () {
    return view('prueba1');
});
Route::get('/prueba2', function () {
    return view('prueba2');
});
Route::get('/prueba3', function () {
    return view('prueba3');
});
Route::get('/prueba4', function () {
    return view('prueba4');
});
Route::get('/prueba5', function () {
    return view('prueba5');
});

Route::get('/sidebar', function () {
    return view('newsidebar');
});

Route::get('/principal', function () {
    return view('principal');
});

Route::get('/menu', function () {
    return View::make('menu');
});

Route::get('/portfolio', function () {
    return view('portfolio');
});
Route::get('/plantilla3', function () {
    return view('plantilla3');
});
Route::get('/plantilla', function () {
    return view('plantilla');
});
