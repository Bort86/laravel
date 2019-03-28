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

Route::view('/home', 'home');

Route::get('/', function () {
    return view('welcome');
})->name('ruta');
//
//Route::get('/category/{id}', function ($id) {
//    return "Piss off: ". $id;//view('welcome');
//});
//
//Route::get('/category/{name?}', function ($name="petete") {
//    return "Piss off: ". $name;//view('welcome');
//});
//
//
//Route::get('/category/{id?}', function ($id="petete") {
//    return "Piss off: ". $id;//view('welcome');
//})->where ('id','\d+') ;
//
//
//Route::get('/category/{id?}', function ($id="petete") {
//    return "Quack off: ". $id;//view('welcome');
//});

Route::view('/', 'welcome', array('name'=>'PROVEN', 'year'=>'2019'))->name('vista');

Route::get('/category/list', 'CategoryController@listAll')->name('catlist');

Route::get('/product/list', 'ProductController@listAll')->name('productlist');

Route::view('/category/create', 'category.create')->name('catcreate');