<?php

Route::get('/','Auth\LoginController@home' );
Auth::routes();
Route::any('/home', function(){ return redirect('client');});
Route::any('wechatlogin','Auth\LoginController@wechatlogin');
Route::any('wechatsuccess', 'Auth\LoginController@wechatsuccess');
Route::resource('client', 'Client\ClientController');

Route::get('manage',function(){return redirect('manage/login');});
Route::get('manage/register', 'Manage\RegistrationController@index')->name('manage.register');
Route::post('manage/register', 'Manage\RegistrationController@store'); 
Route::get('manage/login', 'Manage\SessionsController@index')->name('manage.login');
Route::post('manage/login', 'Manage\SessionsController@store');
Route::get('manage/edit','Manage\EditController@index')->name('manage.edit');
Route::post('manage/edit','Manage\EditController@create');
Route::any('manage/logout', 'Manage\SessionsController@destroy')->name('manage.logout');

Route::resource('manage/cashier', 'Manage\Cashier\CashierController');
Route::resource('manage/admin', 'Manage\Admin\AdminController');
Route::resource('manage/superadmin','Manage\Superadmin\SuperadminController',['as'=>'manage']);

