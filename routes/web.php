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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();


Route::middleware(['auth'])->group(function () {
    /*GENERAL ROUTES*/

    Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

    Route::redirect('/', '/home');
    Route::get('/home', 'HomeController@index');

    Route::redirect('/', '/dashboard');
    Route::get('/dashboard', 'DashboardController@index');

    // Insiders
    Route::get('/admin/insiders/images/{id}/show', 'InsiderController@getImagesForInsiders');
    Route::get('/admin/insiders/get-insiders', 'InsiderController@getInsiders');
    Route::resource('/admin/insiders', 'InsiderController');

    // Criminals
    Route::get('/admin/criminals/images/{id}/show', 'CriminalController@getImagesForCriminals');
    Route::get('/admin/criminals/get-criminals', 'CriminalController@getCriminals');
    Route::resource('/admin/criminals', 'CriminalController');

    // NewsFeed
    Route::get('/news-feed/view-all-news', 'NewsFeedController@showAllNewsFeeds');
    // NewsFeed for admin
    Route::get('/news-feed/images/{id}/show', 'NewsFeedController@getImagesForNewsFeed');
    Route::get('/news-feed/get-all-news-feeds', 'NewsFeedController@getAllNewsFeeds');
    Route::resource('/news-feed', 'NewsFeedController');
});




