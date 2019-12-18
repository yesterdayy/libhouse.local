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

Route::get('/', 'RealtyController@index');

Auth::routes();
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');

Route::get('/cabinet/{id}/search', 'RealtyController@cabinet_search')->name('cabinet.search');

Route::get('/cabinet/{id}/{tab}', 'UserController@get_cabinet_tab');

Route::get('/cabinet/phone', 'UserController@get_phone');
Route::get('/cabinet/{id}', 'UserController@show')->name('cabinet');
Route::get('/cabinet/{id}/edit', 'UserController@edit');


Route::get('/kladr/city', 'KladrController@city');
Route::get('/kladr/street', 'KladrController@street');
Route::get('/kladr/city_and_street', 'KladrController@city_and_street');
Route::get('/kladr/street_with_city', 'KladrController@street_with_city');

Route::get('/search', 'RealtyController@search')->name('realty.search')->middleware('realty.search');

Route::get('/activate/{id}', 'RealtyController@activate');
Route::get('/deactivate/{id}', 'RealtyController@deactivate');
Route::get('/renew/{id}', 'RealtyController@renew');
Route::post('/get_realty_list_widget', 'RealtyController@get_realty_list_widget');
Route::get('/{slug?}', 'IndexController@index')->where('slug', 'kvartira|komnata|dolya|dom|chast-doma|taunkhaus|uchastok|ofis|torgovaya-ploshchad|sklad|obshchepit|garazh|gotovyy-biznes');

Route::get('/', 'RealtyController@index');
Route::get('/create', 'RealtyController@create')->name('realty.create');
Route::post('/', 'RealtyController@store')->middleware('realty.store');
Route::get('/{slug}', 'RealtyController@show')->name('realty.show');
Route::put('/{slug}', 'RealtyController@update')->name('realty.update');
Route::get('/{slug}/edit', 'RealtyController@edit')->name('realty.edit');

Route::get('/favorite/{realty_id}', 'RealtyController@favorite');

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
