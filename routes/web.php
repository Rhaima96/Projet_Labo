<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::resource('labos', 'LaboController');
Route::resource('arrives', 'ArrivageController');
Route::resource('detruits', 'DetruitController');
Route::resource('manques', 'ManquantController');
Route::resource('materiels', 'MaterielController');
Route::resource('pannes', 'PanneController');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
