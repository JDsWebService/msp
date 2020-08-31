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


Auth::routes(['register' => false]);

Route::prefix('admin')->name('admin.')->group(function () {
	// Admin Dashboard
	Route::get('/dashboard', 'Admin\DashboardController@dashboard')->name('dashboard');
});

Route::prefix('contact')->name('contact.')->group(function () {
	Route::post('sendEmail', 'ContactController@sendEmail')->name('sendemail');
	// Route::get('quoteEmailTemplate', function() {
	// 	return new QuoteRequestMail();
	// });
});

Route::get('/', 'PagesController@index')->name('index');