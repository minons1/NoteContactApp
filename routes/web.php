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

Auth::routes();

Route::get('/', 'NotesController@index');
Route::get('create', 'NotesController@create');
Route::post('create', 'NotesController@store');
Route::get('edit/{note}', 'NotesController@edit');
Route::patch('edit/{note}', 'NotesController@update');
Route::get('delete/{note}', 'NotesController@delete');


Route::get('contact', 'ContactsController@index');
Route::get('contact/create', 'ContactsController@create');
Route::post('contact/create', 'ContactsController@store');
Route::get('contact/edit/{contact}', 'ContactsController@edit');
Route::put('contact/edit/{contact}', 'ContactsController@update');
Route::get('contact/delete/{contact}', 'ContactsController@delete');



