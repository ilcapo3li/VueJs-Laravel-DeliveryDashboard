<?php

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
Route::post('/register', 'ApiController@register');
Route::post('/device_app', 'ApiController@deviceTokenRegister');

Route::post('/admin/bicomatics/login','AdminController@login');
Route::post('/company/login','UsersController@login');
Route::post('/representative/login','RepresentativeController@login');
Route::post('/agent/login','AgentController@login');
Route::post('/lead/login','LeadController@login');

Route::post('/logout', 'AuthController@logout');
Route::post('/token/check', 'AuthController@AuthCheck');

/////////////////////////////Bicomatics Admins//////////////////////////////////
Route::group(['prefix' => 'bicomatics','middleware' => ['assign.guard:admin','jwt.auth']],function ()
{
    
    
});

/////////////////////////////Company Users//////////////////////////////////
Route::group(['prefix' => 'company','middleware' => ['assign.guard:user','jwt.auth']],function ()
{
		
});

/////////////////////////////Representative "Tayaar"//////////////////////////////////
Route::group(['prefix' => 'tayar','middleware' => ['assign.guard:representative','jwt.auth']],function ()
{


});

/////////////////////////////Agent ,Suppliers//////////////////////////////////
Route::group(['prefix' => 'suppliers','middleware' => ['assign.guard:agent','jwt.auth']],function ()
{
    
    
});

/////////////////////////////Users Leads//////////////////////////////////
Route::group(['prefix' => 'user','middleware' => ['assign.guard:lead','jwt.auth']],function ()
{
    
    
});



/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////Mobile Api/////////////////////////////////////////
/////////////////////////////////////////checking app device////////////////////////////////////////
//////////////////////////////////Start mobile routes for vistor /////////////////////////////////////////////////////
//  Route::group(['middleware' => ['mobily']], function () {
//      Route::get('/get/settings', 'SettingController@index');
//      Route::get('/ads', 'AdvertisementsController@appAds');

//      //////////////////////////////////END mobile routes for vistor /////////////////////////////////////////////////////

//      ///////////////////////////////////Start Mobile Auth User///////////////////////////
//      Route::group(['middleware' => ['auth', 'blocked']], function () {
         
//          Route::post('/set/like', 'LikeController@setLike');
//          Route::post('/delete/like', 'LikeController@destroyLike');
//          Route::post('/add_comment', 'CommentsController@store');
//          Route::post('/changepasscode', 'UsersController@changePassword');
//          Route::post('/user/favourite', 'UsersController@userFavourite');
//          Route::post('/report', 'ReportController@report');
//          Route::get('/messages', 'ChatsController@fetchMessages');
//          Route::post('/send_message', 'ChatsController@sendMessage');
//          Route::post('/user/name', 'UsersController@changeName');
//          Route::post('/user/photo', 'UsersController@uploadPhoto');
//          ///////////////////////////////////END Mobile Auth User///////////////////////////
//      });
//  });

    //////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////// Admin Panel Production///////////////////////////////////////
    ////////////////////////////////////////Start Admin Auth User///////////////////////////////////////
    // Route::group(['prefix' => adminPath(), 'middleware' => ['adminstration']], function () {

    Route::group(['middleware' => ['isSuper']], function () {
        /////////////////this route working only with  super admin by issuper middleware //////////////////
        /////////////////Start super admin only by permissioncheck middleware //////////////////
       
        Route::get('/admins', 'AdminController@index');
        Route::post('/save/admin', 'AdminController@save');
        Route::put('/update/admin/{admin}', 'AdminController@update');
       
        //////////////////////////////////////////////////////////////////
        Route::get('/permissions', 'PermissionsController@index');
        Route::get('/ads/{app}', 'AdvertisementsController@ads');
        Route::put('/ads/{ads}', 'AdvertisementsController@saveAds');

        /////////////////End super admin only by permissioncheck middleware //////////////////
    });


    // Route::group(['middleware' => ['isPower']], function () {
        /////////////////this route working only with  power admin by issuper middleware //////////////////
        /////////////////Start Power admin only by permissioncheck middleware //////////////////
        // Route::get('/powers', 'PowerController@index');
        // Route::post('/save/power', 'PowerController@save');
        // Route::put('/update/power/{power}', 'PowerController@edit');
        //////////////////////////////////////////////////////////////////
        // Route::get('/superpowers', 'SuperPowerController@index');
        // Route::post('/save/superpower', 'SuperPowerController@save');
        // Route::put('/update/superpower/{superpower}', 'SuperPowerController@edit');
        //////////////////////////////////////////////////////////////////
       
        /////////////////End power admin only by permissioncheck middleware //////////////////
    // });
    ///////////////////////////////////End Super Auth User///////////////////////////

    // Route::group(['middleware' => ['permissioncheck', 'auth', 'blocked']], function () {
    //     /////////////////this route working only with authorize admin only by permissioncheck middleware //////////////////
    //     //////////////////////////////////////////////////////////////////
    //     Route::get('/agents', 'AgentsController@index');
    //     Route::post('/save/agent', 'AgentsController@save');
    //     //////////////////////////////////////////////////////////////////
    //     Route::get('/tayar', 'TayarController@index');
    //     Route::post('/save/tayar', 'TayarController@save');
    //     //////////////////////////////////////////////////////////////////
    //     Route::get('/suppliers', 'SuppliersController@index');
    //     Route::post('/save/supplier', 'SuppliersController@save');
    //     //////////////////////////////////////////////////////////////////
    //     Route::get('/suppliers', 'SuppliersController@index');
    //     Route::post('/save/supplier', 'SuppliersController@save');
    //     //////////////////////////////////////////////////////////////////
    //     Route::get('/leads', 'LeadController@index');
    //     Route::post('/save/lead', 'LeadController@save');
    //     //////////////////////////////////////////////////////////////////
    //     Route::put('/block/user/{user}', 'UsersController@block');
    //     Route::delete('/delete/user/{user}', 'UsersController@destroy');
    //     ///////////////////////////////////////////////////////////////////
    //     Route::get('/zones', 'ZoneController@index')->name('View Zones');
    //     Route::get('/countries', 'CountriesController@index')->name('View Countries');
    //     Route::get('/cities', 'CityController@index')->name('View Cities');

    //     Route::get('/reports', 'ReportController@index')->name('View Reports');
    //     Route::post('/notify/{apk}', 'NotificationsController@sendNotification')->name('Send Notify');
    //     Route::get('/settings', 'SettingController@allSettings')->name('View Settings');
    //     Route::put('/save/settings', 'SettingController@settings')->name('Edit Settings');
    //     Route::get('/versions', 'VersionController@index')->name('View Versions');
    //     Route::post('/upload/version/{app}', 'VersionController@store')->name('Add Version');
    //     Route::delete('/delete/version', 'VersionController@destroy')->name('Remove Version');
    //     Route::get('/get/lastApps', 'VersionController@getLatest')->name('View Versions');
    // });
    // ///////////////////////////////END authorize admin only by permissioncheck middleware ////////////////////////////////////////////

    // Route::group(['middleware' => ['auth']], function () {
    //     /////////////////this route working only with Auth by auth middleware //////////////////

    //     Route::get('/branches', 'BranchController@index');
    //     Route::post('/save/photo', 'PhotosController@uploadPhoto');
    //     Route::post('/delete/photo', 'PhotosController@removePhoto');
    //     Route::get('/all/countries', 'CountriesController@countries');
    //     Route::get('/all/zones', 'ZoneController@allZones');
    //     Route::get('/all/cities', 'CityController@allCities');
    //     Route::get('/all/lead', 'LeadController@addLeads');
    //     Route::get('/all/statuses', 'StatusesController@allStatuses');
    //     Route::get('/all/materialtypes', 'CountriesController@countries');
    //     Route::get('/my/orders', 'OrderController@myOrders');
    //     Route::get('/my/collects', 'OrderController@myCollects');
    //     Route::get('/lead/Orders', 'OrderController@leadOrders');
    //     Route::get('/my/leads', 'LeadController@myLead');
    //     Route::get('/my/locations', 'LocationsController@countries');
    //     Route::get('/search/orders', 'OrderController@search');
    // });
///////////////////////////////////End Admin Auth User/////////////////////////////////////////////////////////////////////////////////
 


/////////////////////////////START Test Propose Only////////////////////////
    // Route::get('/tests', function () {
    // });
//////////////////////////////////END Test//////////////////////////////////
