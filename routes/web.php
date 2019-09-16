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
    return view('welcome');
});
Route::get('/admin-login','admin\UsersController@adminLogin');
Route::post('/authentication','admin\UsersController@authenticate');
Route::get('/logout','admin\UsersController@logout');
Route::any('/forgot/password','admin\UsersController@forgotPassword');
Route::any('/recover/password','admin\UsersController@recoverPassword');
Route::group(['prefix' => 'admin','namespace'=>'admin','middleware' =>'admin'],function(){
    
    Route::get('/index','HomesController@dashboard');
    Route::get('/profile','UsersController@profile');
    Route::post('/update-profile','UsersController@updateProfile');
    Route::get('ajax/serch','CommonController@searchData'); 
    Route::get('status-update/{table}/{id}','CommonController@updateStatus');  
       // Route Location
       Route::group(['prefix' =>'locations'],function(){
        
        Route::get('/','LocationsController@index');
        Route::any('add-location','LocationsController@create');
        Route::any('edit-location/{id}','LocationsController@create');
        Route::get('delete-location/{id}','LocationsController@deleteLocation');
    });
    Route::group(['prefix' =>'products'],function(){
        
        Route::get('/','ProductsController@index');
        Route::any('add-product','ProductsController@create');
        Route::any('edit-product/{id}','ProductsController@create');
        Route::get('delete-product/{id}','ProductsController@deleteProduct');
    });
      
    Route::group(['prefix' =>'template'],function(){
        
        Route::get('/','TemplatesController@index');
        Route::any('add-template','TemplatesController@create');
        Route::any('edit-template/{id}','TemplatesController@create');
        Route::get('delete-template/{id}','TemplatesController@deleteTemplate');
    });

    Route::group(['prefix' =>'versions'],function(){
        
        Route::get('/','VersionController@index');
        Route::any('create-version','VersionController@create');
        // Route::any('edit-template/{id}','TemplatesController@create');
        // Route::get('delete-template/{id}','TemplatesController@deleteTemplate');
    });

});



