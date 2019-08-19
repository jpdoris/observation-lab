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


Auth::routes();

// Override/disable Registration Routes
Route::get('register', function() {
    return redirect('dashboard');
});
Route::post('register', function() {
    return redirect('dashboard');
});


Route::get('/', function () {
    return redirect('dashboard');
});

Route::get('/dashboard/sort/{sortby}/{order}', 'DashboardController@index', '[sortby => $sortby, order => $order]')->name('dashboard.sort');
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/history', 'DashboardController@history')->name('history');

// Report
Route::prefix('report')->group(function(){
    Route::get('create', 'ReportController@create')->name('report.create');
    Route::get('show/{id}', 'ReportController@show', '[id => {id}]')->name('report.show');
//    Route::get('{id}', 'ReportController@edit', '[id => {id}]')->name('report.edit');
    Route::post('create', 'ReportController@store')->name('report.store');
    Route::post('assign', 'ReportController@assign')->name('report.assign');
    Route::post('{id}', 'ReportController@update', '[id => {id}]')->name('report.update');
});

// Review
Route::prefix('review')->group(function(){
    Route::get('check/{id}', 'ReviewController@check', '[report_id => {id}]')->name('review.show');
    Route::get('{id}', 'ReviewController@create', '[report_id => {id}]')->name('review.create');
    Route::post('{id}', 'ReviewController@store', '[report_id => {id}]')->name('review.store');
});

// Treatment
Route::prefix('treatment')->group(function(){
    Route::get('{id}', 'TreatmentController@create', '[report_id => {id}]')->name('treatment.create');
    Route::post('{id}', 'TreatmentController@store', '[report_id => {id}]')->name('treatment.store');
});

// Closeout
Route::prefix('closeout')->group(function(){
    Route::get('{id}', 'CloseoutController@create', '[report_id => {id}]')->name('closeout.create');
    Route::post('{id}', 'CloseoutController@store', '[report_id => {id}]')->name('closeout.store');
});

// Ajax lookups
Route::prefix('lookup')->group(function(){
    Route::post('animal-subtype', 'ApiController@getAnimalSubtypes')->name('animalsubtype');
    Route::post('room', 'ApiController@getRooms')->name('room');
    Route::post('concern-quality', 'ApiController@getConcernQualities')->name('concernqualities');
    Route::post('concern-location', 'ApiController@getConcernLocations')->name('concernlocations');
    Route::post('reviewers', 'ApiController@getReviewers')->name('reviewers');
});

// Admin/Management - Users
Route::prefix('manage/user')->group(function() {
    Route::get('/', 'UserController@index')->name('manage.user.index');
    Route::get('create', 'UserController@create')->name('manage.user.create');
    Route::get('{id}', 'UserController@edit', '[id => {id}]')->name('manage.user.edit');
    Route::post('create', 'UserController@store')->name('manage.user.store');
    Route::post('delete', 'UserController@destroy')->name('manage.user.delete');
    Route::post('{id}', 'UserController@update', '[id => {id}]')->name('manage.user.update');
});

// Admin/Management - Field Options
Route::prefix('manage/options')->group(function() {
    Route::get('/', 'OptionsController@index')->name('manage.options.index');
    Route::get('create', 'OptionsController@create')->name('manage.options.create');
    Route::get('{id}', 'OptionsController@edit', '[id => {id}]')->name('manage.options.edit');

    Route::post('patient/update/{id}', 'OptionsController@updatePatient', '[id => {id}]')->name('manage.options.patient-update');
    Route::post('patient/store', 'OptionsController@storePatient')->name('manage.options.patient-store');
    Route::post('patient/delete/{id}', 'OptionsController@deletePatient', '[id => {id}]')->name('manage.options.patient-delete');

    Route::post('animaltype/update/{id}', 'OptionsController@updateAnimalType', '[id => {id}]')->name('manage.options.animaltype-update');
    Route::post('animaltype/store', 'OptionsController@storeAnimalType')->name('manage.options.animaltype-store');
    Route::post('animaltype/delete/{id}', 'OptionsController@deleteAnimalType', '[id => {id}]')->name('manage.options.animaltype-delete');

    Route::post('animalsubtype/update/{id}', 'OptionsController@updateAnimalSubtype', '[id => {id}]')->name('manage.options.animalsubtype-update');
    Route::post('animalsubtype/store', 'OptionsController@storeAnimalSubtype')->name('manage.options.animalsubtype-store');
    Route::post('animalsubtype/delete/{id}', 'OptionsController@deleteAnimalSubtype', '[id => {id}]')->name('manage.options.animalsubtype-delete');

    Route::post('concernquality/update/{id}', 'OptionsController@updateConcernQuality', '[id => {id}]')->name('manage.options.concernquality-update');
    Route::post('concernquality/store', 'OptionsController@storeConcernQuality')->name('manage.options.concernquality-store');
    Route::post('concernquality/delete/{id}', 'OptionsController@deleteConcernQuality', '[id => {id}]')->name('manage.options.concernquality-delete');

    Route::post('concernlocation/update/{id}', 'OptionsController@updateConcernLocation', '[id => {id}]')->name('manage.options.concernlocation-update');
    Route::post('concernlocation/store', 'OptionsController@storeConcernLocation')->name('manage.options.concernlocation-store');
    Route::post('concernlocation/delete/{id}', 'OptionsController@deleteConcernLocation', '[id => {id}]')->name('manage.options.concernlocation-delete');

    Route::post('concernqualitylocation/get/{id}', 'OptionsController@getConcernQualityLocation', '[id => {id}]')->name('manage.options.concernqualitylocation-get');

    Route::get('building/edit/{id}', 'BuildingController@edit', '[id => {id}]')->name('manage.options.building-edit');
    Route::get('building/edit', 'BuildingController@index')->name('manage.options.building');
    Route::get('building/editroom/{id}', 'BuildingController@editRoom', '[id => {id}]')->name('manage.options.building-editroom');
    Route::get('building/editrooms/{id}', 'BuildingController@editRooms', '[id => {id}]')->name('manage.options.building-editrooms');
    Route::post('building/update/{id}', 'BuildingController@update', '[id => {id}]')->name('manage.options.building-update');
    Route::post('building/updaterooms/{id}', 'BuildingController@updateRooms', '[id => {id}]')->name('manage.options.building-updaterooms');
    Route::post('building/updateroom/{id}', 'BuildingController@updateRoom', '[id => {id}]')->name('manage.options.building-updateroom');
    Route::post('building/store', 'BuildingController@store')->name('manage.options.building-store');

    Route::post('building/store', 'OptionsController@storeBuilding')->name('manage.options.building-store');
    Route::post('building/delete/{id}', 'OptionsController@deleteBuilding', '[id => {id}]')->name('manage.options.building-delete');

    Route::post('room/update/{id}', 'OptionsController@updateRoom', '[id => {id}]')->name('manage.options.room-update');
    Route::post('room/store', 'OptionsController@storeRoom')->name('manage.options.room-store');
    Route::post('room/delete/{id}', 'OptionsController@deleteRoom', '[id => {id}]')->name('manage.options.room-delete');

    Route::post('study/update/{id}', 'OptionsController@updateStudy', '[id => {id}]')->name('manage.options.study-update');
    Route::post('study/store', 'OptionsController@storeStudy')->name('manage.options.study-store');
    Route::post('study/delete/{id}', 'OptionsController@deleteStudy', '[id => {id}]')->name('manage.options.study-delete');

    Route::get('show/{field}', 'OptionsController@getModalData', '[field => {field}]')->name('manage.options.modal.{field}');
    Route::get('edit/{field}', 'OptionsController@getNonModalData', '[field => {field}]')->name('manage.options.edit.{field}');

    Route::post('create', 'OptionsController@store')->name('manage.options.store');
    Route::post('delete', 'OptionsController@destroy')->name('manage.options.delete');
    Route::post('{id}', 'OptionsController@update', '[id => {id}]')->name('manage.options.update');
});
