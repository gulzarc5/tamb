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
Route::group(['namespace' => 'Admin'],function(){
    Route::get('/','LoginController@showLoginForm')->name('admin.login');    
    Route::post('login', 'LoginController@adminLogin');
    Route::post('logout', 'LoginController@logout')->name('admin.logout');

    Route::group(['middleware'=>'auth:admin','prefix'=>'admin'],function(){
        Route::get('/dashboard', 'DashboardController@dashboardView')->name('admin.deshboard');
        Route::post('slot/insert','SlotController@slotInsert')->name('admin.slot_insert');
        Route::get('/slot/edit/{slot_id}', 'SlotController@slotEdit')->name('admin.slot_edit');
        Route::post('/slot/update', 'SlotController@slotUpdate')->name('admin.slot_update');
        Route::get('/slot/delete/{slot_id}', 'SlotController@slotDelete')->name('admin.slot_delete');
        
        Route::get('/change/password/form', 'LoginController@changePasswordForm')->name('admin.change_password_form');
        Route::post('/change/password', 'LoginController@changePassword')->name('admin.change_password');
    });
});

// Route::get('/', function () {
//     return view('admin.index');
// });
