<?php

use App\Mail\QuoteRequestMail;
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

// Authentication Routes
Auth::routes(['register' => false, 'logout' => false, 'confirm' => false]);
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// Public Facing Blog Routes
Route::prefix('blog')->name('blog.')->group(function () {

    Route::get('s/{slug}', 'BlogController@show')->name('show');
    Route::get('/', 'BlogController@index')->name('index');

});

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Portfolio
    Route::resource('portfolio', 'Admin\PortfolioController')->except('show');
    // Categories
    Route::resource('category', 'Admin\CategoryController')->except('show');
    // Blog Management Routes
    Route::prefix('blog')->name('blog.')->group(function () {
        Route::get('create', 'Admin\BlogController@create')->name('create');
        Route::post('create', 'Admin\BlogController@store')->name('store');
        Route::get('edit/{slug}', 'Admin\BlogController@edit')->name('edit');
        Route::post('update/{slug}', 'Admin\BlogController@update')->name('update');
        Route::post('delete/{slug}', 'Admin\BlogController@destroy')->name('delete');
        Route::get('/', 'Admin\BlogController@index')->name('index');
    });
	// Dashboard
	Route::get('/dashboard', 'Admin\DashboardController@dashboard')->name('dashboard');
});

Route::prefix('contact')->name('contact.')->group(function () {
	Route::post('sendEmail', 'ContactController@sendEmail')->name('sendemail');
	// Debug Test Route for QuoteRequestMail
	// Route::get('quoteEmailTemplate', function() {
	// 	return new QuoteRequestMail();
	// });
});

// Portfolio Routes
Route::prefix('portfolio')->name('portfolio.')->group(function () {
    // Index
    Route::get('/', 'PortfolioController@index')->name('index');
    // Show Singular Image
    Route::get('/{slug}', 'PortfolioController@show')->name('show');
});

// Test Route For New Layouts
// Route::get('/testing', 'PagesController@testing')->middleware('auth')->name('testing');
// Generate New QR Code for Google Authenticator App
// Route::get('/barcode', 'PagesController@googleGenerate')->name('barcode');

Route::get('/', 'PagesController@index')->name('index');
