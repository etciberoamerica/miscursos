<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');


Route::get('/', ['as'=>'home','uses'=>'Auth\AuthController@redirectPath']);


Route::get('web',['as'=>'web','uses'=>'Auth\AuthController@webServicesDate']);









// Authentication routes...
//Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::get('/', ['as' => 'auth/login','uses'=>'Auth\AuthController@getLogin']);
Route::post('auth/login', ['as' =>'auth/login', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('auth/logout', ['as' => 'auth/logout', 'uses' => 'Auth\AuthController@getLogout']);

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');

Route::post('auth/register', ['as' => 'auth/register', 'uses' => 'Auth\AuthController@postRegister']);




Route::get('institucion',['as'=>'institucion','uses'=>'InstitutionController@getInstitutions']);

Route::get('auth/state',['as'=>'auth/state','uses'=>'StateController@getState']);


Route::group(['middleware'=>'auth'],function(){



});

/*
 * Rutas del estudiante
 */

Route::group(['middleware'=>'student'],function(){


    Route::get('student', function(){
        return view('users/home');
    });

});


/*
 * Rutas del docente
 */

Route::group(['middleware'=>'teach'],function(){

    Route::get('teach',function(){
        return view('users/home');
    });

});


/*
 * Rutas del Administrador
 */


Route::group(['middleware'=>'admin'],function(){

    Route::get('admin',function(){
        return view('users/home');
    });

});