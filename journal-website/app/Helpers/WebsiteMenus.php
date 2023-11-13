<?php

namespace App\Helpers;

use App\Models\Website\FrontMenu;

class WebsiteMenus
{
    //Frontend menu for header
    public static function menus()
    {
        $menus = FrontMenu::where('parent_id', null)
            ->where('status', 'active')
            ->orderBy('sorting')
            ->where('position', 'header')
            ->get();
        $data = [];
        foreach ($menus as $key => $menu) {
            $data[] = [
                'title' => $menu->title,
                'slug' => $menu->slug,
                'params' => $menu->params,
                'menu_look_type' => $menu->menu_look_type,
                'type' => $menu->type,
                'url' => $menu->url,
                'params' => $menu->params,
            ];
        }

        return $data;
    }

    /**
     *  Frontend side bar menu route check
     *
     * @param [type] $route_name
     * @param [type] $params_name
     * @return void
     */
    public static function getSideMenus($route_name, $params_name)
    {
        if ($route_name == 'web.ecList') {
            $parent = FrontMenu::where('url', 'web.ecList')->first();
            $parentMenus = FrontMenu::with(['childrenMenus'])->where('id', $parent->parent_id)->first();

            return $parentMenus;
        }
    }

    /**
     * Frontend side bar menu
     *
     * @param [type] $myMenus
     * @return void
     */
    public static function sidebarMenus($myMenus)
    {
        $output = '';
        foreach ($myMenus ?? [] as $key => $menu) {
            $curentUrl = request()->route()->parameters['slug'] ?? null;
            $route_name = Route::currentRouteName() ?? null;

            $url = '';
            $active = '';
            if ($menu['type'] == 'content') {
                $url = route('dev.content.show', $menu['slug']);

                if ($curentUrl != null && $curentUrl == $menu['params']) {
                    $active = 'active-menu';
                }
            } elseif ($menu['type'] == 'external_link' && $menu['params'] == null) {
                $url = route($menu['url']);
                if ($route_name == $menu['url'] && $curentUrl == $menu['params']) {
                    $active = 'active-menu';
                }
            } elseif ($menu['type'] == 'external_link' && $menu['params'] != null) {
                $url = route($menu['url'], $menu['params']);
                if ($route_name == $menu['url'] && $curentUrl == $menu['params']) {
                    $active = 'active-menu';
                }
            } else {
                $url = $menu['url'];
                if ($curentUrl == $menu['params']) {
                    $active = 'active-menu';
                }
            }

            if ($menu['title'] == 'Home') {
                $output .= '<li>';
                $output .= '<a data-turbo="false" href="'.$url.'" class="'.$active.'"><i class="bi bi-caret-right"></i> '.$menu['title'].'</a>';
                $output .= '</li>';
            } else {
                $output .= '<li>';
                $output .= '<a href="'.$url.'" class="'.$active.'"><i class="bi bi-caret-right"></i> '.$menu['title'].'</a>';
                $output .= '</li>';
            }
        }

        return $output;
    }

    /**
     * Footer menu
     *
     * @param [type] $fMenu
     * @return void
     */
    public static function footerMenu($fMenu)
    {
        $output = '';
        foreach ($fMenu ?? [] as $footerMenu) {
            $url = '';
            if ($footerMenu['type'] == 'content') {
                $url = route('dev.content.show', $footerMenu['slug']);
            } elseif ($footerMenu['type'] == 'external_link' && $footerMenu['params'] == null) {
                $url = route($footerMenu['url']);
            } elseif ($footerMenu['type'] == 'external_link' && $footerMenu['params'] != null) {
                $url = route($footerMenu['url'], $footerMenu['params']);
            } else {
                $url = $footerMenu['url'];
            }
            $output .= '<li>';
            $output .= '<a href="'.$url.'" target="_blank">'.$footerMenu['title'].'</a>';
            $output .= '</li>';
        }

        return $output;
    }

    /**
     * parent menu or level one menu
     *
     * @param [type] $parentMenus
     * @return void
     */
    public static function addParentMenus($parentMenus)
    {
        $output = '';
        foreach ($parentMenus as $key => $parentMenu) {
            $url = '';

            if ($parentMenu['type'] == 'content') {
                $url = route('dev.content.show', $parentMenu['slug']);
            } elseif ($parentMenu['type'] == 'external_link' && ! isset($parentMenu['params'])) {
                $url = route($parentMenu['url']);
            } elseif ($parentMenu['type'] == 'external_link' && $parentMenu['params'] != null) {
                $url = route($parentMenu['url'], $parentMenu['params']);
            } else {
                $url = $parentMenu['url'];
            }

            if (! empty($parentMenu['all_children_menus'])) {
                if ($parentMenu['menu_look_type'] == 'mega') {
                    $output .= '<li class="nav-item">';
                    $output .= '<a class="nav-link " href="javascript:void(0)">'.$parentMenu['title'].'<i class="fas fa-angle-down"></i></a>';
                    $output .= '<div class="mega-menu">';
                    $output .= ' <div class="row">';
                    $output .= self::addMegaLevelTwo($parentMenu['all_children_menus']);
                    $output .= '</div">';
                    $output .= '</div">';
                    $output .= '</li>';
                } else {
                    $output .= '<li class="nav-item">';
                    $output .= '<a class="nav-link " href="javascript:void(0)">'.$parentMenu['title'].' <i class="fas fa-angle-down"></i></a>';
                    $output .= '<ul class="list-unstyled">';
                    $output .= '<li>';
                    $output .= self::addLevelTwoMenus($parentMenu['all_children_menus']);
                    $output .= '</li>';
                    $output .= '</ul>';
                    $output .= '</li>';
                }
            } else {
                $output .= '<li class="nav-item">';
                $output .= '<a class="nav-link " aria-current="page" href="'.$url.'">'.$parentMenu['title'].'</a>';
                $output .= '</li">';
            }
        }

        return $output;
    }

    /**
     * Child menu or level two menu
     */
    public static function addLevelTwoMenus($levelTwoMenus)
    {
        $output = '';
        foreach ($levelTwoMenus as $key => $levelTwoMenu) {
            $url = '';
            if (
                $levelTwoMenu['type'] == 'content'
            ) {
                $url = route('dev.content.show', $levelTwoMenu['slug']);
            } elseif ($levelTwoMenu['type'] == 'external_link' && $levelTwoMenu['params'] == null) {
                $url = route($levelTwoMenu['url']);
            } elseif ($levelTwoMenu['type'] == 'external_link' && $levelTwoMenu['params'] != null) {
                $url = route($levelTwoMenu['url'], $levelTwoMenu['params']);
            } else {
                $url = $levelTwoMenu['url'];
            }

            if (! empty($levelTwoMenu['all_children_menus'])) {
                $output .= '<li>';
                $output .= '<a href="#" class=""><i class="fas fa-angle-down float-end"></i>'.$levelTwoMenu['title'].'</a>';
                $output .= '<ul class="list-unstyled">';
                $output .= '<li>';
                $output .= self::addLevelThreeMenus($levelTwoMenu['all_children_menus']);
                $output .= '</li>';
                $output .= '</ul>';
                $output .= '</li>';
            } else {

                $output .= '<li>';
                $output .= '<a    href="'.$url.'" class="">'.$levelTwoMenu['title'].'</a>';
                $output .= '<ul class="list-unstyled">';
                $output .= '<li>';
                $output .= self::addLevelThreeMenus($levelTwoMenu['all_children_menus']);
                $output .= '</li>';
                $output .= '</ul>';
                $output .= '</li>';
            }
        }

        return $output;
    }

    /**
     * Child menu or level three menu
     */
    public static function addLevelThreeMenus($levelThreeMenus)
    {
        $output = '';
        foreach ($levelThreeMenus as $key => $levelThreeMenu) {
            $url = '';
            if (
                $levelThreeMenu['type'] == 'content'
            ) {
                $url = route('dev.content.show', $levelThreeMenu['slug']);
            } elseif ($levelThreeMenu['type'] == 'external_link' && $levelThreeMenu['params'] == null) {
                $url = route($levelThreeMenu['url']);
            } elseif ($levelThreeMenu['type'] == 'external_link' && $levelThreeMenu['params'] != null) {
                $url = route($levelThreeMenu['url'], $levelThreeMenu['params']);
            } else {
                $url = $levelThreeMenu['url'];
            }

            // Configure Turbo...
            $isTurboActive = (new WebsiteMenus())->turbo($levelThreeMenu);

            $output .= '<li>';
            $output .= '<a  ol="'.$levelThreeMenu['url'].'" data-turbo = "'.$isTurboActive.'" href="'.$url.'" class="">'.$levelThreeMenu['title'].'</a>';
            $output .= '</li>';
        }

        return $output;
    }

    /**
     * Configuration for turbo-js
     *
     * @param [type] $levelThreeMenu
     * @return bool
     */
    public function turbo($levelThreeMenu)
    {

        $isTurboActive = 'true';

        // For EOI Form...
        if (! empty($levelThreeMenu['url']) && $levelThreeMenu['url'] == 'web.eoi.form') {
            $isTurboActive = 'false';
        }

        // For Chief Member Bodies...
        if (! empty($levelThreeMenu['title']) && $levelThreeMenu['title'] == 'Chief of Member Bodies') {
            $isTurboActive = 'false';
        }

        return $isTurboActive;
    }

    /**
     * Child mega menu or level Two for mega menu
     *
     * @param [type] $levelTwoMenus
     * @return void
     */
    public static function addMegaLevelTwo($levelTwoMenus)
    {
        $output = '';
        foreach ($levelTwoMenus as $key => $megaMenulevelTwo) {
            $url = '';
            if ($megaMenulevelTwo['type'] == 'content') {
                $url = route('dev.content.show', $megaMenulevelTwo['slug']);
            } elseif ($megaMenulevelTwo['type'] == 'external_link' && $megaMenulevelTwo['params'] == null) {
                $url = route($megaMenulevelTwo['url']);
            } elseif ($megaMenulevelTwo['type'] == 'external_link' && $megaMenulevelTwo['params'] != null) {
                $url = route($megaMenulevelTwo['url'], $megaMenulevelTwo['params']);
            } else {
                $url = $megaMenulevelTwo['url'];
            }

            $output .= '<div class="col">';
            $output .= '<h4>'.$megaMenulevelTwo['title'].'</h4>';
            $output .= '<ul class="list-unstyled">';
            $output .= '<li>';
            $output .= self::addMegaLevelThree($megaMenulevelTwo['all_children_menus']);
            $output .= '</li>';
            $output .= ' </ul>';
            $output .= '</div>';
        }

        return $output;
    }

    /**
     * mega menu child level Three
     *
     * @param [type] $megaMenuChildThree
     * @return void
     */
    public static function addMegaLevelThree($megaMenuChildThree)
    {
        $output = '';
        foreach ($megaMenuChildThree as $key => $menuChildThree) {
            $url = '';
            if ($menuChildThree['type'] == 'content') {
                $url = route('dev.content.show', $menuChildThree['slug']);
            } elseif ($menuChildThree['type'] == 'external_link' && $menuChildThree['params'] == null) {
                $url = route($menuChildThree['url']);
            } elseif ($menuChildThree['type'] == 'external_link' && $menuChildThree['params'] != null) {
                $url = route($menuChildThree['url'], $menuChildThree['params']);
            } else {
                $url = $menuChildThree['url'];
            }

            $output .= '<li>';
            $output .= '<a href="'.$url.'"><i class="bi bi-chevron-double-right"></i> '.$menuChildThree['title'].'</a>';
            $output .= '</li>';
        }

        return $output;
    }

    /**
     * main function
     *
     * @param [type] $frontMenus
     * @return void
     */
    public static function menu($frontMenus)
    {
        $output = '';
        // $output .= '<ul class="navbar-nav me-auto mb-2 mb-lg-0">';
        $output .= '<li class="nav-item">';
        $output .= '<a data-turbo="false" class="nav-link" aria-current="page" href="'.url('/').'">Home</a>';
        $output .= self::addParentMenus($frontMenus);
        $output .= '</li >';
        $output .= '</ul>';

        return $output;
    }

    /**
     *Start website mobile menu
     */
    public static function mobileMenu($frontMenus)
    {
        $output = '';
        $output .= '<ul class="list-unstyled">';
        $output .= '<li class="sub-menu">';
        $output .= '<a data-turbo="false" href="'.url('/').'">Home</a>';
        $output .= self::addParentMenusMobile($frontMenus);
        $output .= '</li >';
        $output .= '</ul>';

        return $output;
    }

    /**
     * Undocumented function
     *
     * @param [type] $parentMenus
     * @return void
     */
    // parent menu or level one menu
    public static function addParentMenusMobile($parentMenus)
    {
        $output = '';
        foreach ($parentMenus as $key => $parentMenu) {
            $url = '';
            if ($parentMenu['type'] == 'content') {
                $url = route('dev.content.show', $parentMenu['slug']);
            } elseif ($parentMenu['type'] == 'external_link' && $parentMenu['params'] == null) {
                $url = route($parentMenu['url']);
            } elseif ($parentMenu['type'] == 'external_link' && $parentMenu['params'] != null) {
                $url = route($parentMenu['url'], $parentMenu['params']);
            } else {
                $url = $parentMenu['url'];
            }

            if (! empty($parentMenu['all_children_menus'])) {
                if ($parentMenu['menu_look_type'] == 'mega') {
                    $output .= '<li class="sub-menu">';
                    $output .= '<a  href="javascript:void(0)">'.$parentMenu['title'].'<i class="fas fa-angle-down float-end"></i></a>';
                    $output .= self::addMegaLevelTwoMobile($parentMenu['all_children_menus']);
                    $output .= '</li>';
                } else {
                    $output .= '<li class="sub-menu">';
                    $output .= '<a  href="javascript:void(0)">'.$parentMenu['title'].' <i class="fas fa-angle-down float-end"></i></a>';
                    $output .= '<ul style="display: none;" class="list-unstyled">';
                    $output .= self::addLevelTwoMenusMobile($parentMenu['all_children_menus']);
                    $output .= '</ul>';
                    $output .= '</li>';
                }
            } else {
                $output .= '<li class="sub-menu">';
                $output .= '<a aria-current="page" href="'.$url.'">'.$parentMenu['title'].'</a>';
                $output .= '</li">';
            }
        }

        return $output;
    }

    /**
     * Child menu or level two menu
     *
     * @param [type] $levelTwoMenus
     * @return void
     */
    public static function addLevelTwoMenusMobile($levelTwoMenus)
    {
        $output = '';
        foreach ($levelTwoMenus as $key => $levelTwoMenu) {
            $url = '';
            if (
                $levelTwoMenu['type'] == 'content'
            ) {
                $url = route('dev.content.show', $levelTwoMenu['slug']);
            } elseif ($levelTwoMenu['type'] == 'external_link' && $levelTwoMenu['params'] == null) {
                $url = route($levelTwoMenu['url']);
            } elseif ($levelTwoMenu['type'] == 'external_link' && $levelTwoMenu['params'] != null) {
                $url = route($levelTwoMenu['url'], $levelTwoMenu['params']);
            } else {
                $url = $levelTwoMenu['url'];
            }

            if (! empty($levelTwoMenu['all_children_menus'])) {
                $output .= '<li class="sub-menu">';
                $output .= '<a  href="javascript:void(0)">'.$levelTwoMenu['title'].' <i class="fas fa-angle-down float-end"></i></a>';
                $output .= '<ul style="display: none;" class="list-unstyled">';
                $output .= self::addLevelTheeMenusMobile($levelTwoMenu['all_children_menus']);
                $output .= '</ul>';
                $output .= '</li>';
            } else {

                $output .= '<li class="sub-menu">';
                $output .= '<a  href="'.$url.'">'.$levelTwoMenu['title'].' <i class="fas fa-angle-down float-end"></i></a>';
                $output .= '<ul style="display: none;" class="list-unstyled">';
                $output .= self::addLevelThreeMenus($levelTwoMenu['all_children_menus']);
                $output .= '</ul>';
                $output .= '</li>';
            }
        }

        return $output;
    }

    /**
     * Child menu or level three menu
     *
     * @param [type] $levelThreeMenus
     * @return void
     */
    public static function addLevelTheeMenusMobile($levelThreeMenus)
    {
        $output = '';
        foreach ($levelThreeMenus as $key => $levelThreeMenu) {
            $url = '';
            if (
                $levelThreeMenu['type'] == 'content'
            ) {
                $url = route('dev.content.show', $levelThreeMenu['slug']);
            } elseif ($levelThreeMenu['type'] == 'external_link' && $levelThreeMenu['params'] == null) {
                $url = route($levelThreeMenu['url']);
            } elseif ($levelThreeMenu['type'] == 'external_link' && $levelThreeMenu['params'] != null) {
                $url = route($levelThreeMenu['url'], $levelThreeMenu['params']);
            } else {
                $url = $levelThreeMenu['url'];
            }
            $output .= '<li>';
            $output .= '<a href="'.$url.'" class="">'.$levelThreeMenu['title'].'</a>';
            $output .= '</li>';
        }

        return $output;
    }

    /**
     * Child mega menu or level Two for mega menu
     *
     * @param [type] $levelTwoMenus
     * @return void
     */
    public static function addMegaLevelTwoMobile($levelTwoMenus)
    {
        $output = '';
        foreach ($levelTwoMenus as $key => $megaMenulevelTwo) {
            $url = '';
            if ($megaMenulevelTwo['type'] == 'content') {
                $url = route('dev.content.show', $megaMenulevelTwo['slug']);
            } elseif ($megaMenulevelTwo['type'] == 'external_link' && $megaMenulevelTwo['params'] == null) {
                $url = route($megaMenulevelTwo['url']);
            } elseif ($megaMenulevelTwo['type'] == 'external_link' && $megaMenulevelTwo['params'] != null) {
                $url = route($megaMenulevelTwo['url'], $megaMenulevelTwo['params']);
            } else {
                $url = $megaMenulevelTwo['url'];
            }

            $output .= '<ul style="display: none;" class="list-unstyled">';
            $output .= '<h5 class="fs-5 pb-2 pt-3">'.$megaMenulevelTwo['title'].'</h5>';
            $output .= self::addMegaLevelThreeMobile($megaMenulevelTwo['all_children_menus']);
            $output .= '</ul>';
        }

        return $output;
    }

    /**
     * mega menu child level Three
     *
     * @param [type] $megaMenuChildThree
     * @return void
     */
    public static function addMegaLevelThreeMobile($megaMenuChildThree)
    {
        $output = '';
        foreach ($megaMenuChildThree as $key => $menuChildThree) {
            $url = '';
            if ($menuChildThree['type'] == 'content') {
                $url = route('dev.content.show', $menuChildThree['slug']);
            } elseif ($menuChildThree['type'] == 'external_link' && $menuChildThree['params'] == null) {
                $url = route($menuChildThree['url']);
            } elseif ($menuChildThree['type'] == 'external_link' && $menuChildThree['params'] != null) {
                $url = route($menuChildThree['url'], $menuChildThree['params']);
            } else {
                $url = $menuChildThree['url'];
            }

            $output .= '<li>';
            $output .= '<a href="'.$url.'">'.$menuChildThree['title'].'</a>';
            $output .= '</li>';
        }

        return $output;
    }

    /**
     *End website mobile menu
     */
}
