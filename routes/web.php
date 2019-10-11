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




//Route::get('/', 'LoginController@show')->name('sign_in');
//Route::post('/entry', 'EntranceController@entry')->name('entry');

Route::get('/sign_up', function () {
    return view('main\sign_up');
})->name('sign_up');

Route::post('/sign_up_complete', 'RegistrationController@addAccount')->name('sign_up_complete');

Route::get('/', 'Auth\LoginController@showLoginForm');
//Route::post('auth/login', 'Auth\AuthController@postLogin');
//Route::get('auth/logout', 'Auth\AuthController@getLogout');

Route::group(['prefix'=>'cabinet','middleware' => 'auth'],function () {
    Route::get('/edit', 'EditController@show')->name('edit');
    Route::post('/edit/store', 'EditController@store')->name('edit_complete');

    Route::get('/transfer', 'TransferController@show')->name('transfer');
    Route::post('/transfer/store', 'TransferController@store')->name('transfer_store');

    Route::get('/add_money', 'AddMoneyController@show')->name('add_money');
    Route::post('/add_money_store', 'AddMoneyController@store')->name('add_money_store');


    Route::post('/transaction','TransactionController@store')->name('transaction');

    Route::get('/', 'CabinetController@show')->name('cabinet');

});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
