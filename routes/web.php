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

Route::get('/', 'StaticpageController@index')->name('index');

Route::get('/home', 'HomeController@index')->name('home');
///login
Route::get('/login', 'StaticpageController@login')->name('login');
//dashbord
Route::get('/dashbord', 'DashbordController@showDashbord')->name('dashbord');
Route::get('/dashbord/format', 'DashbordController@showTweetformat')->name('dashbord.format');
Route::get('/dashbord/settings', 'DashbordController@showSettings')->name('dashbord.settings');
//Set GoogleCalendarID
Route::post('/dashbord/settings', 'DashbordController@setCalendarID')->name('dashbord.gcalset');
//Post Tsumiage
Route::post('/post/tsumiages', 'DashbordController@postTsumiage')->name('post.tsumiages');
//Delete Tsumiage
Route::get('/post/{id}/delete', 'DashbordController@deleteTsumiage')->name('post.delete');
//Post(Add) Folder
Route::post('/post/folder', 'DashbordController@postFolder')->name('post.folder');


//search
Route::get('/u', 'SearchController@viewProfile')->name('search');

//Logout
Route::get('/logout', 'SnsBaseController@logout')->name('logout');
//TW Auth
Route::get('/login/twitter', 'SnsBaseController@getAuth')->name('auth.login');
Route::get('/userlogin', 'SnsBaseController@authCallback')->name('auth.callback');

//Jump to Twitter Link
Route::get('/rnicsn', function (){
    return redirect('https://twitter.com/rnicsn');
})->name('jumptwlink');
