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

Route::get('/', function () {
    return redirect()->route('admin.dashboard');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



 Route::prefix('admin')->middleware('admin')->namespace('App\\Http\\Controllers\\Admin')->group(function () {

    // Route::prefix('admin')->namespace('App\\Http\\Controllers\\Admin')->group(function () {
    Route::get('dashboard', 'AdminController@dashboard')->name('admin.dashboard');
Route::get('employees', 'AdminController@employees')->name('admin.employees');
Route::get('department', 'AdminController@department')->name('admin.department');
Route::get('employee/create', 'AdminController@employeeCreate')->name('admin.employees.create');
Route::get('employee/{id}/edit', 'AdminController@employeeEdit')->name('admin.employees.edit');
Route::get('employee/{id}/delete', 'AdminController@employeeDestroy')->name('admin.employees.delete');
// Route::get('employee/{id}/show', 'AdminController@employeeShow')->name('admin.employees.show');
Route::post('employee/{id}/update', 'AdminController@employeeUpdate')->name('admin.employeeUpdate');
Route::post('employees', 'AdminController@employeeStore')->name('admin.employeeStore');
Route::get('attendance_history', 'AdminController@attendance_history')->name('admin.attendance_history');
Route::get('attent_status_disapprove/{id}', 'AdminController@attent_status_disapprove')->name('admin.attent_status_disapprove');
Route::get('attent_status_approve/{id}', 'AdminController@attent_status_approve')->name('admin.attent_status_approve');

Route::post('add_department', 'AdminController@add_department')->name('admin.add_department');
Route::get('depart_status_deactive/{id}', 'AdminController@depart_status_deactive')->name('admin.depart_status_deactive');
Route::get('depart_status_active/{id}', 'AdminController@depart_status_active')->name('admin.depart_status_active');
Route::get('delete_department/{id}', 'AdminController@delete_department')->name('admin.delete_department');
Route::post('edit_department/{id}', 'AdminController@edit_department')->name('admin.edit_department');



});


Route::prefix('employee')->namespace('App\\Http\\Controllers\\Employee')->group(function () {

    Route::get('dashboard', 'EmployeeController@dashboard')->name('employee.dashboard');
    Route::post('start-time', 'EmployeeController@starttime')->name('employee.starttime');
    Route::post('end-time', 'EmployeeController@endtime')->name('employee.endtime');
    Route::get('attendance_history', 'EmployeeController@attendance_history')->name('employee.attendance_history');
});
