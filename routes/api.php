<?php

use App\Setting;
use App\Team;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

////////////////////////////////////////Login, Register& Logout////////////////////////////////////////////////////////
Route::post('/register', 'AuthController@register');
Route::post('/device_app', 'ApiController@deviceTokenRegister');
Route::post('/login', ['as' => 'login', 'uses' => 'AuthController@login']);
Route::post('/logout', 'AuthController@logout');
Route::post('/token/check', 'AuthController@AuthCheck');

/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////Mobile Api/////////////////////////////////////////
/////////////////////////////////////////checking app device////////////////////////////////////////
//////////////////////////////////Start mobile routes for vistor /////////////////////////////////////////////////////
 Route::group(['middleware' => ['mobily']], function () {
  
     Route::get('/get/settings', 'SettingController@index');
     Route::get('/red/ads', 'AdvertisementsController@redAds');
     Route::get('/gold/ads', 'AdvertisementsController@goldAds');
     Route::get('/goldstore/ads', 'AdvertisementsController@goldStoreAds');

     //////////////////////////////////END mobile routes for vistor /////////////////////////////////////////////////////

     ///////////////////////////////////Start Mobile Auth User///////////////////////////
     Route::group(['middleware' => ['auth','blocked']], function () {
         Route::post('/set/favourite', 'FavouriteController@setFavourite');
         Route::post('/delete/favourite', 'FavouriteController@destroyFavourite');
         Route::post('/set/like', 'LikeController@setLike');
         Route::post('/delete/like', 'LikeController@destroyLike');
         Route::post('/add_comment', 'CommentsController@store');
         Route::post('/changepasscode', 'UsersController@changePassword');
         Route::post('/user/favourite', 'UsersController@userFavourite');
         Route::post('/report', 'ReportController@report');
         Route::get('/messages', 'ChatsController@fetchMessages');
         Route::post('/send_message', 'ChatsController@sendMessage');
         Route::post('/user/name', 'UsersController@changeName');
         Route::post('/user/photo', 'UsersController@uploadPhoto');
         ///////////////////////////////////END Mobile Auth User///////////////////////////
     });
 });

    //////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////// Admin Panel Production///////////////////////////////////////
    ////////////////////////////////////////Start Admin Auth User///////////////////////////////////////
    // Route::group(['prefix' => adminPath(), 'middleware' => ['adminstration']], function () {


    Route::group(['middleware' => ['issuper']], function () {
    /////////////////this route working only with  super admin by issuper middleware //////////////////
     /////////////////Start super admin only by permissioncheck middleware //////////////////

        Route::get('/admins', 'AdminController@index');
        Route::post('/save/admin', 'AdminController@save');
        Route::put('/update/admin/{admin}', 'AdminController@edit');
        ////////////////////////////////////////////////////////////////
        Route::get('/agents', 'AgentsController@index');
        Route::post('/save/agent', 'AgentsController@save');
        ////////////////////////////////////////////////////////////////
        Route::get('/tayar', 'TayarController@index');
        Route::post('/save/tayar', 'TayarController@save');
        ////////////////////////////////////////////////////////////////
        Route::get('/suppliers', 'SuppliersController@index');
        Route::post('/save/supplier', 'SuppliersController@saveAdmin');
        ////////////////////////////////////////////////////////////////
        Route::put('/block/user/{user}', 'UsersController@block');
        Route::delete('/delete/user/{user}', 'UsersController@remove');
        ////////////////////////////////////////////////////////////////
        Route::get('/permissions', 'PermissionsController@index');
        Route::get('/ads/{app}', 'AdvertisementsController@ads');
        Route::put('/ads/{ads}', 'AdvertisementsController@saveAds');
   



        /////////////////End super admin only by permissioncheck middleware //////////////////
    });
    ///////////////////////////////////End Super Auth User///////////////////////////

    Route::group(['middleware' => ['permissioncheck', 'auth','blocked']], function () {


        /////////////////this route working only with authorize admin only by permissioncheck middleware //////////////////

        Route::get('/zones', 'ZonesController@index')->name('View Zones');
        Route::get('/countries', 'CountriesController@index')->name('View Countries');
        Route::get('/cities', 'CitiesController@index')->name('View Cities');
 

      

        Route::get('/reports', 'ReportController@index')->name('View Reports');
        Route::post('/notify/{apk}', 'NotificationsController@sendNotification')->name('Send Notify');
        Route::get('/settings', 'SettingController@allSettings')->name('View Settings');
        Route::put('/save/settings', 'SettingController@settings')->name('Edit Settings');
        Route::get('/versions', 'VersionController@index')->name('View Versions');
        Route::post('/upload/version/{app}', 'VersionController@store')->name('Add Version');
        Route::delete('/delete/version', 'VersionController@destroy')->name('Remove Version');
        Route::get('/get/lastApps', 'VersionController@getLatest')->name('View Versions');
    });
    ///////////////////////////////END authorize admin only by permissioncheck middleware ////////////////////////////////////////////




Route::group(['middleware' => ['adminstration']], function () {
    /////////////////this route working only with admin and super admin by adminstration middle ware //////////////////

    Route::get('/branches', 'BranchController@index');
    Route::post('/save/photo', 'PhotosController@uploadPhoto');
    Route::post('/delete/photo', 'PhotosController@removePhoto');
    Route::get('/allCountries', 'CountriesController@countries');
 

});
///////////////////////////////////End Admin Auth User///////////////////////////

    //////////////////////////////START Normal User Watching///////////////////////////////
    Route::post('/report_statue/{report}', 'ReportController@replay');
    Route::post('/report-replay/{user}', 'ReportController@status');

    //////////////////////////////END User Watching///////////////////////////////

    /////////////////////////////START Test Propose Only////////////////////////

   
    Route::get('/tests', function () {
   
        
    });
   

   

    //////////////////////////////////END Test///////////////////////////////////
