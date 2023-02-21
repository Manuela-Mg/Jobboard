<?php

use App\Http\Controllers\AccountManagementController;
use Illuminate\Http\Request;
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

Route::get('/', function () {
    return view('home');
});

Route::get('/login', function()
{
    return view('login');
});

Route::post('/login', function() {
})->name('login');


Route::get('/logout', function() {
    return view('logout');
});

Route::get('/signup', function() {
    return view('signup');
});

Route::post('/signup', function() {
})->name('signup');

Route::get('/admin/user/create', function() {
    return view('admin.user.create');
});

Route::post('/admin/user/create', function() {
})->name('/admin/user/create');

Route::get('/update', function() {
    return view('update');
});

Route::get('/show', function(){
    return view('show');
});

Route::get('/delete/myaccount', function(){
    return view('delete');    
});

Route::get('/apply/{ads_id}', function(){
    return view('apply');   
});

Route::post('/apply/{ads_id}', function() {
})->name('apply');