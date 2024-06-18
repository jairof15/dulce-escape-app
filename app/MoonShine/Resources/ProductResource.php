<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

use MoonShine\Fields\Number;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<Product>
 */
class ProductResource extends ModelResource
{
    protected string $model = Product::class;

    protected string $title = 'Productos';

    protected string $icon = 'fas fa-box';

    protected bool $createInModal = true;

    protected bool $editInModal = true;

    //protected bool $showInModal = true;

    protected bool $detailInModal = true;
    //protected bool $deleteInModal = true;

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Text::make('Descripción:','description')
                    ->sortable()->required()
                    ->placeholder('Descripción del producto.'),
                Number::make('Costo:','cost')
                    ->min(0)
                    ->max(10000)
                    ->step(1.0)
                    ->default(1.00)->buttons()->nullable()
                    ->placeholder('Costo del producto.'),
                Number::make('Porcentaje de Ganancia:','profit_percentage')
                    ->min(0)->max(1)->step(0.01)
                    ->default(0.40)->buttons()->nullable()
                    ->placeholder('Porcentaje de ganancia del producto.'),
                Number::make('Precio:','price')
                    ->min(0)
                    ->max(10000)
                    ->step(1.0)
                    ->default(1.00)->buttons()->nullable()
                    ->placeholder('Precio del producto.'),
                Number::make('Stock:','stock')->sortable()
                    ->min(0)
                    ->max(10000)
                    ->step(1)
                    ->default(0)->buttons()->nullable()
                    ->placeholder('Stock del producto.'),
            ]),
        ];
    }

    /**
     * @param Product $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
