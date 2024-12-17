<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\User;
use MoonShine\Providers\MoonShineApplicationServiceProvider;
use MoonShine\MoonShine;
use MoonShine\Menu\MenuGroup;
use App\Http\Resources\Users;
use App\MoonShine\Resources\UsersResource;
use MoonShine\Menu\MenuItem;
use MoonShine\Models\MoonshineUser;
use MoonShine\Resources\MoonShineUserResource;
use MoonShine\Resources\MoonShineUserRoleResource;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    protected function resources(): array
    {
        return [];
    }

    protected function pages(): array
    {
        return [];
    }

    protected function menu(): array
    {
        return [
            MenuGroup::make(static fn() => __('moonshine::ui.resource.system'), [
               MenuItem::make(
                   static fn() => __('moonshine::ui.resource.admins_title'),
                   new MoonShineUserResource()
               ),
               MenuItem::make(
                   static fn() => __('moonshine::ui.resource.role_title'),
                   new MoonShineUserRoleResource()
                ),
            
            ]),
            MenuGroup::make(static fn() => __('users'), [
                MenuItem::make( 
                    static fn() => __('users'),    
                    new UsersResource
                ),
            ]),
            

            MenuItem::make('Documentation', 'https://moonshine-laravel.com')
               ->badge(fn() => 'Check'),
        ];
    }

    /**
     * @return array{css: string, colors: array, darkColors: array}
     */
    protected function theme(): array
    {
        return [];
    }
}
