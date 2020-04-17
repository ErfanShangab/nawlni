<?php

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Auth::routes();

/*
|------------------------------------------------------------------------------------
| Admin
|------------------------------------------------------------------------------------
*/
// Route::group(['prefix' => ADMIN, 'as' => ADMIN . '.', 'middleware'=>['auth', 'Role:10']], function () {

 Route::group(['prefix' => 'admin', 'as' => 'admin' . '.' , 'middleware' => 'auth'], function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('/', 'DashboardController@index')->name('dash');
Route::resource('users', 'UserController');
Route::resource('customers', 'CustomerController');

Route::resource('drivers', 'DriverController');
Route::resource('orders', 'OrderController');
Route::resource('pays', 'PayController');
Route::resource('messages', 'MessageController');

Route::resource('clients', 'ClientController');
Route::resource('configs', 'ConfigController');


});
Route::get('/clients/pharmacy', 'ClientController@pharmacy')->name('/clients/pharmacy');
Route::get('/clients/resturant', 'ClientController@resturant')->name('/clients/resturant');
Route::get('/clients/merchant', 'ClientController@merchant')->name('/clients/merchant');

Route::group(['middleware' => ['role:agent']], function () {
    Route::get('/showProfile/{id}', 'ClientController@showProfile');

});

// Route::resource('users', 'UserController');
Route::get('/', 'DashboardController@index');

 
