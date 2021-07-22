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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/admin/kuesioner', function () {
//     return view('admin/kuesioner');
// });


route::get('/','loginController@index');
route::post('/logins','loginController@login');
route::get('/logouts','loginController@logout');



Route::group(['prefix' => 'admin',  'middleware' => 'AdminMiddleware'],function(){


    //Admin
    Route::get('/auth/profile', 'ProfileController@profile');
    Route::post('/auth/profile/update','ProfileController@update');
    //Route::post('/auth/profile/upload','ProfileController@upload')->name("crop-image-upload");


    //Alumni
    Route::get('/alumni','alumniController@show');
    Route::post('/alumni/create','alumniController@create');
    //Route::get('/alumni/{id}/edit','alumniController@edit');
    Route::post('/alumni/update','alumniController@update');
    Route::get('/alumni/{id}/delete','alumniController@delete');

    // ajax request only
    // Route::get('/alumni/province', 'alumniController@province');
    // Route::get('/alumni/regency', 'alumniController@regency');
    // Route::get('/alumni/district', 'alumniController@district');
    // Route::get('cities', [\App\Http\Controllers\CityController::class, 'index'])
    // ->name('cities.index');

    // Route::get('states', [\App\Http\Controllers\StateController::class, 'index'])
    // ->name('states.index');

    //Pengumuman
    Route::get('/pengumuman','pengumumanController@show');
    Route::get('/pengumuman/create','pengumumanController@create');
    Route::post('/pengumuman/store', 'pengumumanController@store');
    Route::get('/pengumuman/{id}/delete', 'pengumumanController@delete');
    Route::get('/pengumuman/showpengumuman/{id}', 'pengumumanController@detail');
    Route::get('/pengumuman/{id}/edit', 'pengumumanController@edit');
    Route::post('/pengumuman/{id}', 'pengumumanController@update');

    Route::post('/pengumuman/{id}', 'pengumumanController@send');
    Route::post('/pengumuman/showpengumuman/send-message/{id}', 'TelegramBotController@storeMessage');

    //Lowongan
    Route::get('/lowongan','lowonganController@show');
    Route::get('/lowongan/create','lowonganController@create');
    Route::post('/lowongan/store', 'lowonganController@store');
    Route::get('/lowongan/{id}/delete', 'lowonganController@delete');
    Route::get('/lowongan/showlowongan/{id}', 'lowonganController@detail');
    Route::get('/lowongan/{id}/edit', 'lowonganController@edit');
    Route::post('/lowongan/{id}', 'lowonganController@update');


    //Master Angkatan
    Route::get('/angkatan','angkatanController@show');
    Route::post('/masterangkatan/create','angkatanController@create');
    //Route::get('/masterangkatan/{id}/edit','angkatanController@edit');
    Route::post('/masterangkatan/update','angkatanController@update');
    Route::get('/masterangkatan/{id}/delete','angkatanController@delete');

    
    //Master Prodi
    Route::get('/prodi','prodiController@show');
    Route::post('/masterprodi/create','prodiController@create');
    //Route::get('/masterprodi/{id}/edit','prodiController@edit');
    Route::post('/masterprodi/update','prodiController@update');
    Route::get('/masterprodi/{id}/delete','prodiController@delete');

    //Kuesioner
    Route::get('/kuesioner','kuesionerController@show');
    Route::post('/kuesioner/create','kuesionerController@create');
    Route::post('/kuesioner/update','kuesionerController@update');
    Route::get('/kuesioner/{id}/delete','kuesionerController@delete');
    Route::get('/kuesioner/showkuesioner/{id}','kuesionerController@detail')->name('show-kuesioner');

    Route::get('/tracer','kuesionerController@showtracer');
    
    //Detail Kuesioner
    Route::post('/kuesioner/soal/create','detailkuesionerController@create');
    Route::delete('/kuesioner/soal/{id}/delete', 'detailkuesionerController@delete');
    Route::get('/kuesioner/soal/{id}/edit', 'detailkuesionerController@edit');
    Route::post('/kuesioner/soal/{id}/update','detailkuesionerController@update');

    // Route::get('/alumni', 'DependentDropdownController@index')->name('alumni');
    // Route::post('/alumni', 'DependentDropdownController@store')
    // ->name('alumni');
    Route::get('/dashboard','dashboardController@dashboard')->middleware('AdminMiddleware');


    //Export Excel
    Route::get('/export', 'dashboardController@export');

});







Route::prefix('pimpinan')->group(function(){
    // route::get('/','loginController@index');
    // route::post('/logins','loginController@login');
    // route::get('/logouts','loginController@logout');
    //Alumni
    Route::get('/alumni','pimpinanalumniController@show');
    Route::post('/alumni/create','pimpinanalumniController@create');
    //Route::get('/alumni/{id}/edit','pimpinanalumniController@edit');
    Route::post('/alumni/update','pimpinanalumniController@update');
    Route::get('/alumni/{id}/delete','pimpinanalumniController@delete');


    //Kuesioner
    Route::get('/kuesioner','pimpinankuesionerController@show');
    Route::post('/kuesioner/create','pimpinankuesionerController@create');
    Route::post('/kuesioner/update','pimpinankuesionerController@update');
    Route::get('/kuesioner/{id}/delete','pimpinankuesionerController@delete');
    Route::get('/kuesioner/showkuesioner/{id}','pimpinankuesionerController@detail')->name('show-kuesioner');

    //Pengumuman
    Route::get('/pengumuman','pengumumanController@show');
    Route::get('/pengumuman/create','pengumumanController@create');
    Route::post('/pengumuman/store', 'pengumumanController@store');
    Route::get('/pengumuman/{id}/delete', 'pengumumanController@delete');
    Route::get('/pengumuman/showpengumuman/{id}', 'pengumumanController@detail');
    Route::get('/pengumuman/{id}/edit', 'pengumumanController@edit');
    Route::post('/pengumuman/{id}', 'pengumumanController@update');


    //lowongan
    Route::get('/lowongan','lowonganController@show');
    Route::get('/lowongan/create','lowonganController@create');
    Route::post('/lowongan/store', 'lowonganController@store');
    Route::get('/lowongan/{id}/delete', 'lowonganController@delete');
    Route::get('/lowongan/showlowongan/{id}', 'lowonganController@detail');
    Route::get('/lowongan/{id}/edit', 'lowonganController@edit');
    Route::post('/lowongan/{id}', 'lowonganController@update');

    Route::get('/dashboard','dashboardpimpinanController@dashboard');


});
//1624417891:AAFwIpCtR4rqQ5FtvvYuk_Q9G6DIM8KmHL0
//@TracerStudyFTUnud_Bot



//Telegram
//Route::get('/', 'TelegramBotController@sendMessage');
// Route::post('/send-message', 'TelegramBotController@storeMessage');
// Route::get('/send-photo', 'TelegramBotController@sendPhoto');
// Route::post('/store-photo', 'TelegramBotController@storePhoto');
// Route::get('/updated-activity', 'TelegramBotController@updatedActivity');

//Route::post('/send-message', 'Notifications/TelegramNotification@toTelegram');



