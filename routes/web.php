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

/**
 * Routes for Home controller
 */
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index');
Route::get('/home/{locale}', 'HomeController@locale');

/**
 * Routes for User controller
 */
Route::get('/users', 'UserController@index')->name('users');
Route::get('/user/create', 'UserController@create')->name('user.create');
Route::post('/user/store', 'UserController@store')->name('user.store');
Route::get('/user/{id}', 'UserController@show')->name('user.show');
Route::get('/user/{id}/edit', 'UserController@edit')->name('user.edit');
Route::put('/user/{id}', 'UserController@update')->name('user.update');
Route::delete('/user/{id}', 'UserController@destroy')->name('user.destroy');

/**
 * Routes for Company controller
 */
Route::get('/memberships', 'MembershipController@index')->middleware('role:Manager')->name('memberships');
Route::get('/membership/create', 'MembershipController@create')->middleware('role:Manager')->name('membership.create');
Route::post('/membership/store', 'MembershipController@store')->middleware('role:Manager')->name('membership.store');
Route::get('/membership/{id}', 'MembershipController@show')->middleware('role:Manager')->name('membership.show');
Route::get('/membership/{id}/edit', 'MembershipController@edit')->middleware('role:Manager')->name('membership.edit');
Route::put('/membership/{id}', 'MembershipController@update')->middleware('role:Manager')->name('membership.update');
Route::delete('/membership/{id}', 'MembershipController@destroy')->middleware('role:Manager')->name('membership.destroy');

/**
 * Routes for Employee controller
 */
Route::get('/members', 'MemberController@index')->middleware('role:Manager')->name('members');
Route::get('/rmembe/create', 'MemberController@create')->middleware('role:Manager')->name('member.create');
Route::post('/member/store', 'MemberController@store')->middleware('role:Manager')->name('member.store');
Route::get('/member/{id}', 'MemberController@show')->middleware('role:Manager')->name('member.show');
Route::get('/member/{id}/edit', 'MemberController@edit')->middleware('role:Manager')->name('member.edit');
Route::put('/member/{id}', 'MemberController@update')->middleware('role:Manager')->name('member.update');
Route::delete('/member/{id}', 'MemberController@destroy')->middleware('role:Manager')->name('member.destroy');


