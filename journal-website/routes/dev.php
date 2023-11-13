<?php

use App\Http\Controllers\WebsiteController;

// The route file holds the system-related routes for the application,
// handling navigation and functionality specific to the system.

// CloudFlare Route...
// Route::get('cloudflare', function () {
//     return '
//         <form action="'.route('upload.image').'" method="POST" enctype="multipart/form-data">
//             '.csrf_field().'
//             <input type="file" name="image">
//             <button type="submit">Upload Image</button>
//         </form>
//     ';
// });
// Route::post('cloudflare/upload', [WebsiteController::class, 'store'])->name('upload.image');

// System Route...

// Get Current Environment Route...
Route::get('app/environment', [App\Http\Controllers\Admin\System\LibController::class, 'environment']);

// Initialize System Route...
Route::get('app/initialize-systems', [App\Http\Controllers\Admin\System\LibController::class, 'systems']);

// Application Authentication Verification Route...
Auth::routes(['verify' => false]);

// Application Storage Link Route...
Route::get('/sym', function () {
    File::link(storage_path('app/public'), public_path('storage'));

    return response()->json('Link Create Successfully!');
});

// Application Cache Clear Route...
Route::get('/clear', function () {
    Artisan::call('optimize:clear');

    return response()->json('Cache Cleared Successfully!');
});

// Code Playground Route...
Route::get('code', function () {
    return view('code');
});
