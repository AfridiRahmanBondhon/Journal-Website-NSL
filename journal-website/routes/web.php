<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\Admin\OrderController;

use App\Http\Controllers\Dev\WebsiteController;
use App\Http\Controllers\Admin\ContactsController;
use App\Http\Controllers\WebsiteController as ProductionWebsiteController;

// Dev Website Route...
Route::get('/', [JournalController::class, 'index'])->name('home');
Route::get('/content', [JournalController::class, 'content'])->name('content');
Route::get('/feature', [JournalController::class, 'feature'])->name('feature');
Route::get('/faq', [JournalController::class, 'faq'])->name('faq');
Route::get('/contact-us', [JournalController::class, 'contactUs'])->name('contact-us');
Route::post('/contact-us/form', [ContactsController::class, 'store'])->name('contact-Us');

Route::post('/order/form', [OrderController::class, 'store'])->name('order');
Route::get('/order-form', [JournalController::class, 'orderForm'])->name('order-form');

Route::get('/about-us', [JournalController::class, 'index'])->name('about-us');
Route::get('/terms-of-use', [JournalController::class, 'index'])->name('terms-of-use');
Route::get('/privacy-policy', [JournalController::class, 'index'])->name('privacy-policy');
Route::post('/news/letter', [JournalController::class, 'newsLetter'])->name('news-letter');

//Route::get('/', [ProductionWebsiteController::class, 'index'])->name('home');

// Dev Website Route...
Route::prefix('dev')->name('dev.')->group(function () {

    // Dev Home Route...
    Route::get('/', [WebsiteController::class, 'index'])->name('home');

    // Content Route...
    Route::get('dev/content/view/{slug}', [WebsiteController::class, 'content'])->name('content.show');

    // Event Route...
    Route::get('dev/events', [WebsiteController::class, 'events'])->name('event.index');
    Route::get('dev/event/{slug}', [WebsiteController::class, 'eventShow'])->name('event.show');

    // News Route...
    Route::get('dev/news', [WebsiteController::class, 'news'])->name('news.index');
    Route::get('dev/news/{slug}', [WebsiteController::class, 'newsShow'])->name('news.show');

    // Notice Route...
    Route::get('dev/notice', [WebsiteController::class, 'notice'])->name('notice.index');
    Route::get('dev/notice/{slug}', [WebsiteController::class, 'noticeShow'])->name('notice.show');

    // Contact Us Route...
    Route::post('dev/contact', [WebsiteController::class, 'contactStore'])->name('contact.store');

    // Gallery Route...
    Route::get('dev/albums', [WebsiteController::class, 'albums'])->name('albums.index');
    Route::get('dev/photos/{album_id}', [WebsiteController::class, 'photos'])->name('photos.index');
    Route::get('dev/videos/{album_id}', [WebsiteController::class, 'videos'])->name('videos.index');
});

// Admin Route...
Route::group(['prefix' => '', 'as' => 'admin.'], function () {
    Route::get('/nsl-admin', [App\Http\Controllers\Auth\AdminLoginController::class, 'login'])->name('nsl_admin');
    Route::post('/nsl-login', [App\Http\Controllers\Auth\AdminLoginController::class, 'login']);
    Route::get('/login-check', [App\Http\Controllers\Auth\AdminLoginController::class, 'loginCheck'])->name('loginCheck');
});
