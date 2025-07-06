<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');


Route::middleware('auth')->group(function(){

    Route::get('/dashboard', 'Dashboard\DashboardController@index')->name('dashboard');
    
    //route movie
    Route::get('/dashboard/movies', 'Dashboard\MovieController@index')->name('dashboard.movies');
    Route::get('/dashboard/movies/create', 'Dashboard\MovieController@create')->name('dashboard.movies.create');
    Route::post('/dashboard/movies/store', 'Dashboard\MovieController@store')->name('dashboard.movies.store');
    Route::get('/dashboard/movies/{movie}', 'Dashboard\MovieController@edit')->name('dashboard.movies.edit');
    Route::put('/dashboard/movies/{movie}', 'Dashboard\MovieController@update')->name('dashboard.movies.update');
    Route::delete('/dashboard/movies/{movie}', 'Dashboard\MovieController@destroy')->name('dashboard.movies.delete');
    
    //route theater
    Route::get('/dashboard/theaters', 'Dashboard\TheaterController@index')->name('dashboard.theaters');
    Route::get('/dashboard/theaters/create', 'Dashboard\TheaterController@create')->name('dashboard.theaters.create');
    Route::post('/dashboard/theaters/store', 'Dashboard\TheaterController@store')->name('dashboard.theaters.store');
    Route::get('/dashboard/theaters/{theater}', 'Dashboard\TheaterController@edit')->name('dashboard.theaters.edit');
    Route::put('/dashboard/theaters/{theater}', 'Dashboard\TheaterController@update')->name('dashboard.theaters.update');
    Route::delete('/dashboard/theaters/{theater}', 'Dashboard\TheaterController@destroy')->name('dashboard.theaters.delete');

    //route arrange movie
    Route::get('/dashboard/theaters/arrange/movies/{theater}', 'Dashboard\ArrangeMovieController@index')->name('dashboard.arrange.movie');
    Route::get('/dashboard/theaters/arrange/movies/create/{theater}', 'Dashboard\ArrangeMovieController@create')->name('dashboard.arrange.movie.create');
    Route::post('/dashboard/theaters/arrange/movies/store', 'Dashboard\ArrangeMovieController@store')->name('dashboard.arrange.movie.store');
    Route::get('/dashboard/theaters/arrange/movies/{theater}/{arrangeMovie}', 'Dashboard\ArrangeMovieController@edit')->name('dashboard.arrange.movie.edit');
    Route::post('/dashboard/theaters/arrange/movies/{theater}/{arrangeMovie}', 'Dashboard\ArrangeMovieController@update')->name('dashboard.arrange.movie.update');
    Route::delete('/dashboard/theaters/arrange/movies/{theater}/{arrangeMovie}', 'Dashboard\ArrangeMovieController@destroy')->name('dashboard.arrange.movie.delete');

    Route::get('/dashboard/tickets', 'Dashboard\TicketController@index')->name('dashboard.tickets');


    // route user
    Route::get('/dashboard/users', 'Dashboard\UserController@index')->name('dashboard.users');
    Route::get('/dashboard/users/{id}', 'Dashboard\UserController@edit')->name('dashboard.user.edit');
    // menggunakan custom method 'put' bawaan laravel untuk proses mengupdate data
    Route::put('/dashboard/users/{id}', 'Dashboard\UserController@update')->name('dashboard.user.update');
    // menggunakan custom method 'delete' bawaan laravel untuk proses menghapus data
    Route::delete('/dashboard/users/{id}', 'Dashboard\UserController@destroy')->name('dashboard.user.delete');

});