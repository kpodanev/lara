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



Route::get('', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/users', 'HomeController@users')->name('users');
Route::get('/categories/', 'HomeController@categoryIndex')->name('categories.index');
Auth::routes();

Route::middleware(['role'])->group(function(){
    Route::post('/categories/save', 'HomeController@save')->name('categories.save');
    Route::get('/categories/create/{slug?}', 'HomeController@create')->name('categories.create');
    Route::get('/categories/delete/{id}', 'HomeController@categoryDelete')->name('categories.delete');
    Route::get('/categories/{slug}', 'HomeController@category')->name('categories.show');
});


Auth::routes();



