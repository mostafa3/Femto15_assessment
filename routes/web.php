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

Auth::routes(['verify' => true]);
Auth::routes();

Route::view('welcome', 'welcome');

Route::get('/home', function(){return 'profile';})->middleware('verified');
Route::prefix('admin')->group(function () {
  Route::get('/login', 'Auth\AdminLoginController@login_form')->name('admin_login');
  Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin_logout');
  Route::post('/login', 'Auth\AdminLoginController@login');

  Route::get('/employees', 'AdminController@employees')->name('employees');
  Route::get('/employees/new', 'AdminController@new_employee_form')->name('new_employee');
  Route::post('/employees/new', 'AdminController@create_employee');
  Route::get('/employee/{id}', 'AdminController@edit_employee_form')->name('edit_employee');
  Route::put('/employee', 'AdminController@update_employee');
  Route::get('/employee/change_password/{id}', 'AdminController@change_password_form')->name('change_password');
  Route::put('/employee/updatePassword', 'AdminController@updatePassword');
  Route::delete('/employee/delete_employee', 'AdminController@delete_employee');

  Route::get('/companies', 'AdminController@companies')->name('companies');
  Route::get('/companies/new', 'AdminController@new_company_form')->name('new_company');
  Route::post('/companies/new', 'AdminController@create_company');
  Route::get('/company/{id}', 'AdminController@edit_company_form')->name('edit_company');
  Route::put('/company', 'AdminController@update_company');
  Route::delete('/company/delete_company', 'AdminController@delete_company');
});
Route::post('ajax/employee_search','AjaxController@employee_search');
Route::post('ajax/company_search','AjaxController@company_search');
