<?php

namespace App;

class Menu
{

    public function showMenu()
    {

        $menus = [

            'home' => [
                'icon' => 'flaticon-dashboard',
                'name' => __('pages.home'),
                'notification' => 0,
                'route' => 'admin_home',
                'routeNames' => ['admin_home'],
                'subMenu' => [],
            ],
            'users' => [
                'icon' => 'flaticon-users',
                'name' => __('pages.users'),
                'notification' => 0,
                'route' => 'admin.users.index',
                'routeNames' => ['admin.users.index', 'admin.users.edit', 'admin.users.create'],
                'subMenu' => [],
            ],
            'accounts' => [
                'icon' => 'flaticon-cart',
                'name' => __('pages.accounts'),
                'notification' => 0,
                'route' => 'admin.accounts.index',
                'routeNames' => ['admin.accounts.index', 'admin.accounts.edit', 'admin.accounts.create'],
                'subMenu' => [],
            ],
            'categories' => [
                'icon' => 'flaticon-list-3',
                'name' => __('pages.categories'),
                'notification' => 0,
                'route' => 'admin.categories.index',
                'routeNames' => ['admin.categories.index', 'admin.categories.edit', 'admin.categories.create'],
                'subMenu' => [],
            ],
            'countries' => [
                'icon' => 'flaticon-map-location',
                'name' => __('pages.countries'),
                'notification' => 0,
                'route' => 'admin.countries.index',
                'routeNames' => ['admin.countries.index', 'admin.countries.edit', 'admin.countries.create'],
                'subMenu' => [],
            ],
            'notifications' => [
                'icon' => 'flaticon-bell',
                'name' => __('pages.notifications'),
                'notification' => 0,
                'route' => 'admin.notifications.index',
                'routeNames' => ['admin.notifications.index'],
                'subMenu' => [],
            ],
            'search_history' => [
                'icon' => 'flaticon-search',
                'name' => __('pages.search_history'),
                'notification' => 0,
                'route' => 'admin.search_history.index',
                'routeNames' => ['admin.search_history.index'],
                'subMenu' => [],
            ],
            'reports_and_analytics' => [
                'icon' => 'flaticon-graph',
                'name' => __('pages.reports_and_analytics'),
                'notification' => 0,
                'route' => 'admin.reports.categories_visits',
                'routeNames' => ['admin.reports.categories_visits', 'admin.reports.featured_visits', 'admin.reports.vote_report', 'admin.reports.clicks_report', 'admin.reports.top_level_clicks'],
                'subMenu' => [
                    ['name' => __('pages.categories_visits'), 'route' => 'admin.reports.categories_visits'],
                    ['name' => __('pages.featured_visits'), 'route' => 'admin.reports.featured_visits'],
                    ['name' => __('pages.category_featured_visits'), 'route' => 'admin.reports.category_featured_visits'],
                    ['name' => __('pages.vote_report'), 'route' => 'admin.reports.vote_report'],
                    ['name' => __('pages.clicks_report'), 'route' => 'admin.reports.clicks_report'],
                    ['name' => __('pages.top_level_clicks'), 'route' => 'admin.reports.top_level_clicks'],
                ],
            ],

            'settings' => [
                'icon' => 'flaticon-settings',
                'name' => __('pages.settings'),
                'notification' => 0,
                'route' => 'admin.settings.index',
                'routeNames' => ['admin.settings.index'],
                'subMenu' => [],
            ],
            'administrators' => [
                'icon' => 'flaticon-user-settings',
                'name' => __('pages.administrators'),
                'notification' => 0,
                'route' => 'admin.administrators.index',
                'routeNames' => [
                    'admin.administrators.index', 'admin.administrators.create', 'admin.administrators.edit',
                    'admin.roles.index', 'admin.roles.create', 'admin.roles.edit'],
                'subMenu' => [
                    ['name' => __('pages.administrators'), 'route' => 'admin.administrators.index'],
                    ['name' => __('pages.roles'), 'route' => 'admin.roles.index'],
                ],
            ],

        ];

        foreach ($menus as $key => $menu) {
            if (auth('admins')->user()->hasPermission($menu['route']) || $menu['route'] == 'admin_home'):
                ?>
                <li class="m-menu__item <?php echo (in_array(\Request::route()->getName(), $menu['routeNames'])) ? 'm-menu__item--open m-menu__item--expanded' : '' ?> <?php echo (count($menu['subMenu']) > 0) ? 'm-menu__item--submenu' : ''; ?>" <?php echo (count($menu['subMenu']) > 0) ? 'aria-haspopup="true" data-menu-submenu-toggle="hover"' : ''; ?>>
                    <a href="<?php echo route($menu['route']); ?>"
                       class="m-menu__link <?php echo (count($menu['subMenu']) > 0) ? 'm-menu__toggle' : ''; ?>">
                        <i class="m-menu__link-icon <?php echo $menu['icon']; ?>"></i>
                        <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text"><?php echo $menu['name']; ?></span>
                            <?php if ($menu['notification'] > 0) : ?>
                                <span class="m-menu__link-badge">
                              <span class="m-badge m-badge--danger"><?php echo $menu['notification']; ?></span>
                            </span>
                            <?php endif; ?>
                        </span>
                    </span>
                        <?php if (count($menu['subMenu']) > 0) : ?>
                            <i class="m-menu__ver-arrow la la-angle-right"></i>
                        <?php endif; ?>
                    </a>

                    <?php if (count($menu['subMenu']) > 0) : ?>

                        <div class="m-menu__submenu">
                            <span class="m-menu__arrow"></span>
                            <ul class="m-menu__subnav">

                                <?php foreach ($menu['subMenu'] as $submenu) : ?>
                                    <li class="m-menu__item <?php echo ($submenu['route'] == \Request::route()->getName()) ? 'm-menu__item--active' : ''; ?> ">
                                        <a href="<?php echo route($submenu['route']); ?>" class="m-menu__link ">
                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                            <span class="m-menu__link-text"><?php echo $submenu['name']; ?></span>
                                        </a>
                                    </li>
                                <?php endforeach; ?>

                            </ul>
                        </div>

                    <?php endif; ?>

                </li>

            <?php
            endif;
        }


    }
}
