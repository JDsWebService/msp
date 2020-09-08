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


Auth::routes(['register' => false, 'logout' => false, 'confirm' => false]);
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Portfolio
    Route::resource('portfolio', 'Admin\PortfolioController')->except('show');
    // Categories
    Route::resource('category', 'Admin\CategoryController')->except('show');
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

// Test Route For New Layouts
Route::get('/testing', 'PagesController@testing')->name('testing');

Route::get('/', 'PagesController@index')->name('index');
