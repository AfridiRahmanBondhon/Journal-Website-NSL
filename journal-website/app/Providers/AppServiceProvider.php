<?php

namespace App\Providers;

use App\Models\Feature;
use App\Models\LandingPage;
use App\Models\Testimonial;
use App\Models\BannerModule;
use App\Models\VideoContent;
use App\Models\Website\FrontMenu;
use App\Models\System\SiteSetting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Schema\Blueprint;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Blueprint::macro('userlog', function () {
            $this->string('created_by', 100)->nullable();
            $this->string('created_ip', 50)->nullable();
            $this->string('updated_by', 100)->nullable();
            $this->string('updated_ip', 50)->nullable();
        });

        //
        View()->composer('*', function ($view) {
            $view->with('landingPage', LandingPage::where('status','active')->orderBy('sorting', 'asc')->first());
            $view->with('features', Feature::where('status','active')->get());
            $view->with('testimonial', Testimonial::where('status','active')->get());
            $view->with('bannerModule', BannerModule::first());
            $view->with('siteSetting', SiteSetting::first());
            $view->with('footerMenu', FrontMenu::where('position', 'footer_bottom')->get());
            $view->with('frontMenus', app()->make('frontMenuObj'));

        });
    }
}
