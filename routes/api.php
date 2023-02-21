<?php

use App\Http\Controllers\Api\Ads\AdsCRUDController;
use App\Http\Controllers\Api\Company\CompanyCRUDController;
use App\Http\Controllers\Api\JobApp\JobAppCRUDController;
use App\Http\Controllers\Api\User\AccountManagementController;
use App\Http\Controllers\Api\User\ApiSecurityController;
use App\Http\Controllers\Api\User\UserCRUDController;
use App\Models\Company;
use Illuminate\Http\Request;
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

const USER_ID = 'user/{id}';
const JOBAPP_ID = 'jobapp/{id}';
const ADS_ID = 'ads/{id}';
const COM_ID = 'com/{id}';

// advertisements crud routes
Route::controller(AdsCRUDController::class)->group(function () {
    Route::get('ads/list', 'index');
    Route::post('newads/{com_id}', 'add');
    Route::get(ADS_ID, 'show');
    Route::put(ADS_ID, 'update');
    Route::delete(ADS_ID, 'delete');
});
// auth routes
Route::controller(ApiSecurityController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('signup', 'addUser');
    Route::post('logout', 'logout');
});
// user account managements routes
Route::controller(AccountManagementController::class)->group(function () {
    Route::put('update', 'updateUser');
    Route::get('show', 'getUserDetails');
    Route::delete('/delete/myaccount', 'deleteAuthUser');
});

// user crud routes
Route::controller(UserCRUDController::class)->group(function () {
    Route::get('user/list', 'index');
    Route::post('new/user', 'add');
    Route::get(USER_ID, 'show');
    Route::put(USER_ID, 'update');
    Route::delete(USER_ID, 'delete');
});

// Company crud routes
Route::controller(CompanyCRUDController::class)->group(function () {
    Route::get('com/list', 'index');
    Route::post('newcom/{user_id}', 'add');
    Route::get(COM_ID, 'show');
    Route::put(COM_ID . '/{user_id?}', 'update');
    Route::delete(COM_ID, 'delete');
});
// jobapp crud routes
Route::controller(JobAppCRUDController::class)->group(function () {
    Route::post('/apply/{ads_id}', 'addJobApplication');
    Route::get('jobapp/list', 'index');
    Route::post('newjobapp/{user_id}/{ads_id}', 'add');
    Route::get(JOBAPP_ID, 'show');
    Route::put(JOBAPP_ID, 'update');
    Route::delete(JOBAPP_ID, 'delete');
});
