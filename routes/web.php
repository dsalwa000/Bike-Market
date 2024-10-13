<?php

use App\Http\Controllers\BikeController;

// Log-in
Route::get('/user', 'UserController@index');

// General sub-pages
Route::get('/', 'BikeController@index');
Route::post('/results', 'BikeController@results');
Route::get('/aboutUs', 'BikeController@aboutUs');
Route::get('/buyback', 'BikeController@buyback');
Route::get('/ourShop', 'BikeController@ourShop');
Route::get('/showBike/{bike}', 'BikeController@showBike');

// General form
Route::post('/sendConfirmationCodeGeneral', 'BikeController@sendConfirmationCodeGeneral');
Route::post('/sendFormGeneral', 'BikeController@sendFormGeneral');

// Single bike form
Route::post('/sendConfirmationCodeSingleBike/{bikeID}', 'BikeController@sendConfirmationCodeSingleBike');
Route::post('/sendFormSingleBike', 'BikeController@sendFormSingleBike');

// Buyback form
Route::post('/sendConfirmationCodeBuyback', 'BikeController@sendConfirmationCodeBuyback');
Route::post('/sendFormBuyback', 'BikeController@sendFormBuyback');

// PDF
Route::get('/pdfOffer', 'BikeController@pdfOffer');
Route::get('/showRower/download/{bike}', 'BikeController@pdfSingleBike');


// Admin pages
Route::get('/admin', 'AdminController@index');
Route::get('/admin/editPages', 'AdminController@editPages');

Route::get('/admin/editPages/glowna', 'AdminController@glowna');
Route::patch(
    '/admin/editPages/glowna/{oferta}',
    'AdminController@changeoferta'
);

Route::get('/mail', 'BikeController@mail');

Route::get('/admin/editPages/onas', 'AdminController@onas');
Route::patch('/admin/editPages/onas/{onas}', 'AdminController@changeonas');

Route::get('/admin/editPages/programowaie', 'AdminController@programowaie');
Route::patch('/admin/editPages/programowanie/{programowanie}', 'AdminController@changeprogramowanie');

Route::get('/admin/editPages/skup', 'AdminController@skup');
Route::patch('/admin/editPages/skup/{skup}', 'AdminController@changeskup');

Route::get('/admin/editPages/finansowanie', 'AdminController@finansowanie');
Route::patch('/admin/editPages/finansowanie/{finansowanie}', 'AdminController@changefinansowanie');

Route::get('/admin/editPages/kontakt', 'AdminController@kontakt');
Route::patch('/admin/editPages/kontakt/{kontakt}', 'AdminController@changekontakt');

Route::get('/admin/editPages/wspolne', 'AdminController@baner');
Route::patch('/admin/editPages/wspolne/{baner}', 'AdminController@changebaner');

Route::get('/admin/kategorie', 'AdminController@kategorie');
Route::get('/admin/showAll', 'AdminController@showAll');
Route::post('/admin/kontroler', 'AdminController@kontroler');
Route::post('/admin/stanowisko', 'AdminController@stanowisko');
Route::post('/admin/przeznaczenie', 'AdminController@przeznaczenie');
Route::post('/admin/producent', 'AdminController@producent');
Route::post('/admin/stan', 'AdminController@stan');
Route::post('/admin/liczba_osi', 'AdminController@liczba_osi');

Route::get('/admin/robot', 'AdminController@robot');
Route::post('/admin/robot/crate', 'AdminController@robot_create');

Route::get('/admin/showAll/{robotID}', 'AdminController@zdjeciaRobota');
Route::get('/admin/showAll/downloadPhotos/{formularz}', 'AdminController@download');

Route::get('/admin/image', 'AdminController@image');
Route::post('/admin/image/create', 'AdminController@create_image');

Route::get('/admin/choose', 'AdminController@chooseRobot');
Route::get('/admin/choose/{robot}', 'AdminController@changeRobot');
Route::patch('admin/choose/{robot}/change', 'AdminController@storeRobot');

Route::get('/admin/delete', 'AdminController@delete');
Route::delete('/admin/delete/robot', 'AdminController@deleteRobot');
Route::delete('/admin/delete/przeznaczenie', 'AdminController@deletePrzeznaczenie');
Route::delete('/admin/delete/osie', 'AdminController@deleteOsie');
Route::delete('/admin/delete/producent', 'AdminController@deleteProducent');
Route::delete('/admin/delete/stanowisko', 'AdminController@deleteStanowisko');
Route::delete('/admin/delete/kontroler', 'AdminController@deleteKontroler');
Route::delete('/admin/delete/stan', 'AdminController@deleteStan');


Auth::routes();
