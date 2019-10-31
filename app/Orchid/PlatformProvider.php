<?php

declare(strict_types=1);

namespace App\Orchid;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Orchid\Composers\MainMenuComposer;

class PlatformProvider extends ServiceProvider
{
    /**
     * Boot the application events.
     *
     * @param Dashboard $dashboard
     */
    public function boot(Dashboard $dashboard)
    {
        View::composer('platform::dashboard', MainMenuComposer::class);

        $dashboard->registerResource('stylesheets', '/admin/sass/admin.css');
        $dashboard->registerResource('scripts', '/admin/js/admin.js');
        $dashboard->registerResource('scripts', '/plugins/ekko-lightbox/ekko-lightbox.min.js');
        $dashboard->registerResource('stylesheets', '/plugins/dragula/dragula.min.css');
        $dashboard->registerResource('scripts', '/plugins/dragula/dragula.min.js');

        $this->loadViewsFrom(app_path('/Orchid'), 'orchid');

        $dashboard
            //->registerPermissions($this->registerPermissionsMain())
            ->registerPermissions($this->registerPermissionsSystems());

        $dashboard->registerGlobalSearch([
            //...Models
        ]);
    }

    /**
     * @return ItemPermission
     */
    protected function registerPermissionsMain(): ItemPermission
    {
        return ItemPermission::group(__('Main'))
            ->addPermission('platform.index', __('Main'))
            ->addPermission('platform.systems', __('Systems'))
            ->addPermission('platform.systems.index', __('Settings'));
    }

    /**
     * @return ItemPermission
     */
    protected function registerPermissionsSystems(): ItemPermission
    {
        return ItemPermission::group(__('Systems'))
            ->addPermission('platform.systems.roles', __('Roles'))
            ->addPermission('platform.systems.users', __('Users'))
            ->addPermission('platform.systems.comments', __('Comments'))
            ->addPermission('platform.systems.category', __('Category'));
    }
}
