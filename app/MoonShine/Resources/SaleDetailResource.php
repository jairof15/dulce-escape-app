<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\SaleDetail;

use MoonShine\Fields\Number;
use MoonShine\Fields\Select;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<SaleDetail>
 */
class SaleDetailResource extends ModelResource
{
    protected string $model = SaleDetail::class;

    protected array $parentRelations = [
        'name' => 'sale',
        'type' => 'belongsTo',
    ];

    protected string $title = 'Detalles de Venta';

    protected string $icon = 'fas fa-shopping-cart';

    protected bool $createInModal = true;

    protected bool $editInModal = true;

    protected bool $detailInModal = true;

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Number::make('Venta', 'sale_id')->sortable()->disabled(),
                // Relación con la tabla products:
                Select::make('Producto', 'product_id')
                    ->options(
                        \App\Models\Product::all()
                            // Obtener description del producto:
                            ->pluck('description', 'id')
                            ->toArray()
                    )
                    ->required()
                    ->placeholder('Seleccione un producto.'),
                Number::make('Cantidad', 'quantity')
                    ->required()
                    ->placeholder('Cantidad de productos vendidos.'),
                Number::make('Precio', 'price')
                    ->required()
                    ->placeholder('Precio del producto.'),
                Number::make('Total', 'total')->disabled(),
            ]),
        ];
    }

    /**
     * @param SaleDetail $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
