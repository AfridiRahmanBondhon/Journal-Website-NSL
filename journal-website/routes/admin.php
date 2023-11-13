<?php

use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\Support\SupportController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

// Backend Route...
Route::group(['prefix' => 'backend', 'as' => 'backend.'], function () {

    // Auth Route...
    Route::post('forget', [App\Http\Controllers\Auth\AdminLoginController::class, 'forget'])->name('forget');
    Route::any('password-reset', [App\Http\Controllers\Auth\AdminLoginController::class, 'reset'])->name('reset');
});

// Authorized Route...
Route::group(['middleware' => 'auth:admin'], function () {

    // Support Route...
    Route::get('support/countries', [SupportController::class, 'countries']);

    // Custom Pagination Example Route...
    Route::get('custom/pagination', [ProfileController::class, 'news']);

    // Sitemap Route...
    Route::get('sitemap-data', [App\Http\Controllers\Admin\System\ActivityLogController::class, 'sitemapData'])->name('sitemapData');

    // Auth Route...
    Route::post('logout', [App\Http\Controllers\Auth\AdminLoginController::class, 'logout'])->name('logout');

    // Systems Route...
    Route::get('systems-update', [App\Http\Controllers\Admin\System\RoleController::class, 'systemsRoleUpdate']);
    Route::get('get-permissions', [App\Http\Controllers\Admin\System\RoleController::class, 'getPermissions']);
    Route::get('get-menus/{any?}', [App\Http\Controllers\Admin\System\MenuController::class, 'menus']);
    Route::get('initialize-systems', [App\Http\Controllers\Admin\System\LibController::class, 'systems']);

    // Category Route...
    Route::get('get-category/{type}', [App\Http\Controllers\Admin\CategoryController::class, 'getCategory']);

    // Admin Route...
    Route::post('check-old-password', [App\Http\Controllers\Admin\AdminController::class, 'checkOldPassword']);
    Route::post('change-password', [App\Http\Controllers\Admin\AdminController::class, 'passwordChange']);
    Route::get('get-dashboard-menus', [App\Http\Controllers\Admin\System\MenuController::class, 'dashboardMenu']);

    // Module Route...
    Route::view('module', 'layouts.admin_app')->name('module.index');
    Route::get('module/check-model', [App\Http\Controllers\Admin\System\ModuleController::class, 'checkModel']);

    // Table Route...
    Route::get('table-sorting', [App\Http\Controllers\Base\SortingController::class, 'sorting']);
    Route::get('get-last-sorting', [App\Http\Controllers\Base\SortingController::class, 'lastSorting']);

    // Menu Route...
    Route::get('parent-menus', [App\Http\Controllers\Admin\Website\FrontMenuController::class, 'getParentMenu']);
    Route::get('get-content', [App\Http\Controllers\Admin\Website\ContentController::class, 'index']);
    Route::get('get-album/{type}', [App\Http\Controllers\Admin\Website\Gallery\AlbumController::class, 'album']);
    Route::get('module-delete', [App\Http\Controllers\Admin\System\ModuleController::class, 'moduleDelete'])->name('module.delete');

    // Slider Route...
    Route::get('slider-height-width/{id}', [App\Http\Controllers\Admin\Website\Gallery\SliderDetailsController::class, 'heightWidth']);

    // User Permission Based Routing...
    Route::middleware('auth.access')->group(function () {

        // Dashboard Route...
        Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard.index');

        // Content Route...
        Route::get('content', [App\Http\Controllers\Admin\Website\ContentController::class, 'index'])->name('content.index');
        Route::post('content', [App\Http\Controllers\Admin\Website\ContentController::class, 'store'])->name('content.store');
        Route::get('content/{slug}', [App\Http\Controllers\Admin\Website\ContentController::class, 'show'])->name('content.show');
        Route::get('content/create', [App\Http\Controllers\Admin\Website\ContentController::class, 'create'])->name('content.create');
        Route::get('content/{slug}/edit', [App\Http\Controllers\Admin\Website\ContentController::class, 'edit'])->name('content.edit');
        Route::get('content-file/{slug}', [App\Http\Controllers\Admin\Website\ContentController::class, 'file'])->name('content.file');
        Route::post('content-file/{content}', [App\Http\Controllers\Admin\Website\ContentController::class, 'storeFile'])->name('content.storeFile');
        Route::delete('content/{id}', [App\Http\Controllers\Admin\Website\ContentController::class, 'destroy'])->name('content.destroy');

        // Frontend Route...
        Route::resource('album', App\Http\Controllers\Admin\Website\Gallery\AlbumController::class);
        Route::resource('photo', App\Http\Controllers\Admin\Website\Gallery\PhotoController::class);
        Route::resource('video', App\Http\Controllers\Admin\Website\Gallery\VideoController::class);
        Route::resource('slider', App\Http\Controllers\Admin\Website\Gallery\SliderController::class);
        Route::resource('frontMenu', App\Http\Controllers\Admin\Website\FrontMenuController::class);
        Route::resource('news', App\Http\Controllers\Admin\Website\NewsController::class);
        Route::resource('notice', App\Http\Controllers\Admin\Website\NoticeController::class);
        Route::resource('category', App\Http\Controllers\Admin\CategoryController::class);
        Route::resource('contacts', App\Http\Controllers\Admin\ContactsController::class);
        Route::resource('faq', App\Http\Controllers\Admin\FaqController::class);
        Route::resource('events', App\Http\Controllers\Admin\EventsController::class);

        // Slider Details Route...
        Route::resource('slider-details', App\Http\Controllers\Admin\Website\Gallery\SliderDetailsController::class);

        // Module Route...
        Route::match(['get', 'post'], 'module/create', [App\Http\Controllers\Admin\System\ModuleController::class, 'create'])->name('module.create');
        Route::get('sitemap-data', [App\Http\Controllers\Admin\System\ActivityLogController::class, 'sitemapData'])->name('sitemapData');

        // Activity Log Route...
        Route::get('activityLog', [App\Http\Controllers\Admin\System\ActivityLogController::class, 'index'])->name('activityLog.index');
        Route::get('activityLog/{id}', [App\Http\Controllers\Admin\System\ActivityLogController::class, 'show'])->name('activityLog.show');
        Route::get('allRead', [App\Http\Controllers\Admin\System\ActivityLogController::class, 'allRead'])->name('activityLog.allRead');
        Route::delete('activityLog/{id}', [App\Http\Controllers\Admin\System\ActivityLogController::class, 'destroy'])->name('activityLog.destroy');

        // Admin Route...
        Route::resource('role', App\Http\Controllers\Admin\System\RoleController::class);
        Route::resource('menu', App\Http\Controllers\Admin\System\MenuController::class);
        Route::resource('siteSetting', App\Http\Controllers\Admin\System\SiteSettingController::class);
        Route::resource('admin', App\Http\Controllers\Admin\AdminController::class);
        Route::get('sitemap', [App\Http\Controllers\Admin\System\ActivityLogController::class, 'sitemap'])->name('sitemap')->withOutMiddleWare('auth.access');
        // Route::resource('profile', App\Http\Controllers\Admin\ProfileController::class);
        // Route::resource('plugin', App\Http\Controllers\Admin\PluginController::class);
        Route::resource('landingPage', App\Http\Controllers\Admin\LandingPageController::class);
        Route::resource('bannerModule', App\Http\Controllers\Admin\BannerModuleController::class);
        Route::resource('feature', App\Http\Controllers\Admin\FeatureController::class);
        // Route::resource('videoContent', App\Http\Controllers\Admin\VideoContentController::class);
        Route::resource('testimonial', App\Http\Controllers\Admin\TestimonialController::class);
        Route::resource('order', App\Http\Controllers\Admin\OrderController::class);
    });
});
