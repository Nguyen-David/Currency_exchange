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

Route::get('/', function () {
    return view('main\sign_in');
})->name('sign_in');

Route::get('/sign_up', function () {
    return view('main\sign_up');
})->name('sign_up');

Route::post('/sign_up_complete', 'RegistrationController@addAccount')->name('sign_up_complete');

//Route::group(['prefix'=>'cabinet','as'=>'cabinet.'],function () {
    Route::post('/replenish', 'CabinetController@addMoney')->name('replenish');

    Route::get('/cabinet/{id}', 'CabinetController@show')->name('cabinet');

//});






Route::get('/edit/{id}', 'EditController@show')->name('edit');
