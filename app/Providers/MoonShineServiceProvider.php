<?php

declare(strict_types=1);

namespace App\Providers;

use App\MoonShine\Resources\CustomerResource;
use App\MoonShine\Resources\ProductResource;
use App\MoonShine\Resources\SaleDetailResource;
use App\MoonShine\Resources\SaleResource;
use MoonShine\Providers\MoonShineApplicationServiceProvider;
use MoonShine\MoonShine;
use MoonShine\Menu\MenuGroup;
use MoonShine\Menu\MenuItem;
use MoonShine\Resources\MoonShineUserResource;
use MoonShine\Resources\MoonShineUserRoleResource;
use MoonShine\Contracts\Resources\ResourceContract;
use MoonShine\Menu\MenuElement;
use MoonShine\Pages\Page;
use Closure;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    /**
     * @return list<ResourceContract>
     */
    protected function resources(): array
    {
        return [];
    }

    /**
     * @return list<Page>
     */
    protected function pages(): array
    {
        return [];
    }

    /**
     * @return Closure|list<MenuElement>
     */
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

            /*
            MenuItem::make('Documentation', 'https://moonshine-laravel.com/docs')
                ->badge(fn() => 'Check')
                ->blank(),*/

            MenuItem::make('Productos', new ProductResource),
            MenuItem::make('Clientes', new CustomerResource),
            MenuItem::make('Ventas', new SaleResource),
            MenuItem::make('Detalles de Venta', new SaleDetailResource),

        ];
    }

    /**
     * @return Closure|array{css: string, colors: array, darkColors: array}
     */
    protected function theme(): array
    {
        return [];
    }
}
