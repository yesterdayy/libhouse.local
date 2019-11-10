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

Route::get('/', 'IndexController@index');

Auth::routes();
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');

Route::get('/user/phone', 'UserController@get_phone');
Route::get('/user/{id}', 'UserController@show')->name('cabinet');
Route::get('/user/{id}/edit', 'UserController@edit');

Route::get('/kladr/city', 'KladrController@city');
Route::get('/kladr/street', 'KladrController@street');
Route::get('/kladr/city_and_street', 'KladrController@city_and_street');
Route::get('/kladr/street_with_city', 'KladrController@street_with_city');

Route::get('/realty/search', 'RealtyController@search')->name('realty.search');

Route::get('/realty/activate/{id}', 'RealtyController@activate');
Route::get('/realty/deactivate/{id}', 'RealtyController@deactivate');
Route::get('/realty/renew/{id}', 'RealtyController@renew');
Route::post('/realty/get_realty_list_widget', 'RealtyController@get_realty_list_widget');
Route::get('/realty/{slug?}', 'IndexController@index')->where('slug', 'kvartira|komnata|dolya|dom|chast-doma|taunkhaus|uchastok|ofis|torgovaya-ploshchad|sklad|obshchepit|garazh|gotovyy-biznes');

Route::get('/realty', 'RealtyController@index');
Route::get('/realty/create', 'RealtyController@create')->name('realty.create');
Route::post('/realty', 'RealtyController@store');
Route::get('/realty/{slug}', 'RealtyController@show')->name('realty.show');
Route::put('/realty/{slug}', 'RealtyController@update')->name('realty.update');
Route::get('/realty/{slug}/edit', 'RealtyController@edit')->name('realty.edit');

Route::post('/comment/add_comment/{type}', 'CommentController@add_comment');
Route::post('/comment/get_comments/{type}', 'CommentController@get_comments');

Route::post('/upload', 'BlogController@upload');
Route::post('/blog/share/{id}', 'BlogController@share');

/* FileManager */
Route::get('/dashboard/filemanager', 'Filemanager\FilemanagerController@get_files');

Route::middleware(['forms'])->group(function () {
    Route::post('/form/submit', 'FormController@submit');
});

Route::post('/upload/photo', 'UploadController@photo');
Route::post('/upload/photo_document', 'UploadController@photo_document');
Route::post('/upload/avatar', 'UploadController@avatar');
