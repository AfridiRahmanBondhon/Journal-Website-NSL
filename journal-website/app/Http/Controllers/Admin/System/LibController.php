<?php

namespace App\Http\Controllers\Admin\System;

use App\Http\Controllers\Controller;
use App\Models\Website\Gallery\Slider;
use Illuminate\Support\Facades\App;

class LibController extends Controller
{
    private $variable = [];

    private function index()
    {
        return [
            'variable' => $this->variable,
        ];
    }

    /**
     * Initialize date of system
     *
     * @return array
     */
    public function systems()
    {
        return [
            'global' => $this->index(),
            'permissions' => App::make('premitedMenuArr'),
            'site' => App::make('siteSettingObj'),
            'menus' => App::make('sideMenus'),
            'sliderPosition' => $this->sliderPostionList(),
            'sliderLists' => Slider::get(),
            'sliderButtonTypes' => $this->sliderButtonTypes(),
            'categoriesModuleNames' => $this->categoriesModuleNames(),
            'user' => auth('admin')->user(),
        ];
    }

    /**
     * Slider button lists
     *
     * @return array
     */
    public function sliderButtonTypes()
    {
        return [
            'Inside',
            'Outside',
        ];
    }

    /**
     * Slider position list
     *
     * @return array
     */
    public function sliderPostionList()
    {
        return [
            'Header',
            'Footer',
        ];
    }

    /**
     * Member designation type
     *
     * @return array
     */
    public function categoriesModuleNames()
    {
        return [
            ['name' => 'Notice', 'value' => 'Notice'],
            ['name' => 'Events', 'value' => 'Events'],
            ['name' => 'News', 'value' => 'News'],
        ];
    }

    /**
     * Get Current environment
     *
     * @return string
     */
    public function environment()
    {

        $currentUrl = url()->current();

        if (
            str_contains($currentUrl, 'localhost')
            || str_contains($currentUrl, '127.0.0.1')
            || str_contains($currentUrl, '192.168.')
            || str_contains($currentUrl, '103.169.160.21')
        ) {
            return 'local';
        } else {
            return 'production';
        }
    }
}
