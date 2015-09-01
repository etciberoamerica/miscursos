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


Route::get('insert',['as'=>'insert', 'uses' => 'UseretcController@getProcedure']);
Route::get('us',['as'=>'us', 'uses' => 'UseretcController@getData']);
Route::get('prueba',['as'=>'prueba', 'uses' => 'UseretcController@prueba']);






/*Route::get('/', function () {
    return view('login');
});*/
Route::get('/', ['as' => '/','uses'=>'Auth\AuthController@getLogin']);



// Authentication routes...
//Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::get('auth/login', ['as' => '/','uses'=>'Auth\AuthController@getLogin']);
Route::post('auth/login', ['as' =>'auth/login', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('auth/logout', ['as' => 'auth/logout', 'uses' => 'Auth\AuthController@getLogout']);

// Registration routes...
Route::get('register', ['as' => 'auth/register', 'uses' => 'Auth\AuthController@getRegister']);

Route::post('register', ['as' => 'auth/register', 'uses' => 'Auth\AuthController@postRegister']);
Route::get('key',['as' =>'auth/key','uses' =>'UserController@getDate']);







Route::get('institucion',['as'=>'institucion','uses'=>'InstitutionController@getInstitutions']);

Route::get('auth/state',['as'=>'auth/state','uses'=>'StateController@getState']);


Route::group(['middleware'=>'auth'],function(){

    Route::get('/home', function () {
        return view('auth/home');
    });


    Route::get('find/product',['as'=> 'find/product','uses'=>'ProductoetcController@findAll']);


});

/*
 * Rutas del estudiante
 */

Route::group(['middleware'=>'student'],function(){

    Route::get('student',['as'=> 'student', 'uses'=>'UserController@student']);

});


/*
 * Rutas del docente
 */

Route::group(['middleware'=>'teach'],function(){

    Route::get('teacher',['as'=>'teacher','uses'=>'UserController@teacher']);

    Route::post('teacher',['as'=>'teacher','uses'=>'UserController@groupRegister']);





});


/*
 * Rutas del Administrador
 */


Route::group(['middleware'=>'admin'],function(){

    Route::get('admin',['as'=>'admin','uses'=>'UserController@admin']);

});


Route::group(['middleware'=>'adviser'],function(){

    Route::get('adviser',['as'=>'adviser','uses'=>'UserController@adviser']);

});


Route::get('prueba',['as'=>'prueba','uses'=>'UserController@prueba']);