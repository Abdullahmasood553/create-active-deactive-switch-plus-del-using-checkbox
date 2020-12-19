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

Route::get('/', 'UserController@users')->name('users');
Route::get('changeStatus', 'UserController@changeStatus')->name('changeStatus');



// Delete Listing
Route::delete('/deleteall', 'UserController@deleteall');