<?php

Route::get('/blog/filter_posts', 'BlogController@filter_posts');
Route::get('/blog/cat/{id?}', 'BlogController@cat');
Route::get('/blog/tag/{id}', 'BlogController@tag');

Route::get('/{slug_dir}/{slug?}', 'BlogController@single_page')->where(['slug_dir' => '^(?!dashboard).*$']);
Route::get('/{slug?}', 'BlogController@single_page')->where(['slug_dir' => '^(?!dashboard).*$']);
