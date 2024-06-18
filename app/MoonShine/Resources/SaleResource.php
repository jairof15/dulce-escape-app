<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Sale;
use App\MoonShine\Resources\SaleDetailResource;
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Date;
use MoonShine\Fields\Number;
use MoonShine\Fields\Select;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Resources\ModelResource;
use MoonShine\Fields\Relationships\HasMany;
use MoonShine\Fields\Relationships\BelongsTo;

/**
 * @extends ModelResource<Sale>
 */
class SaleResource extends ModelResource
{
    protected string $model = Sale::class;

    protected array $parentRelations = [
        'name' => 'saleDetails',
        'type' => 'hasMany',
    ];

    protected string $title = 'Ventas';

    protected string $icon = 'fas fa-shopping-cart';

    protected bool $createInModal = true;

    protected bool $editInModal = false;

    protected bool $detailInModal = true;

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Date::make('Fecha de Venta:','date')->sortable()
                    ->required()->placeholder('Fecha de la venta.')
                    //->format('d/m/Y')
                    ->default(date('Y-m-d'))->disabled(),
                // Relación con la tabla customers:
                Select::make('Cliente','customer_id')
                    ->options(
                        \App\Models\Customer::all()
                            // Obtener el nombre y apellido del cliente:
                            ->map(fn($customer) => $customer->name . ' ' . $customer->last_name)
                            //->pluck('id')
                            ->toArray()
                    )
                    ->placeholder('Cliente de la venta.')
                    // Permitir buscar clientes por nombre:
                    ->searchable()->default(1)
                    ->required(),
                // Mostrar el nombre del cliente en lugar del id:
                //Text::make('customer.name')->label('Cliente'),
                Number::make('Total de la Venta:','total')
                    ->disabled()->default(0.00),
                // Relación con la tabla sale_details: Permite crear detalles de venta en el mismo formulario
                HasMany::make('Detalles de Venta', 'saleDetails', resource: new SaleDetailResource())
                    ->fields([
                        /*Select::make('Producto', 'product_id')
                            ->options(
                                \App\Models\Product::all()
                                    // Obtener description del producto:
                                    ->pluck('description', 'id')
                                    ->toArray()
                            )
                            ->required()
                            ->placeholder('Seleccione un producto.'),*/
                        BelongsTo::make('Producto', 'product_id', resource: new ProductResource())
                            ->required()
                            ->placeholder('Seleccione un producto.'),
                        Number::make('Cantidad', 'quantity')
                            ->required()
                            ->placeholder('Cantidad de productos vendidos.'),
                        Number::make('Precio', 'price')
                            ->required()
                            ->placeholder('Precio del producto.'),
                        Number::make('Total', 'total')->disabled(),
                    ])
                    ->creatable(
                        button: ActionButton::make('Agregar Detalle de Venta','')
                    )
                    ->onlyLink(),

            ]),
        ];
    }

    /**
     * @param Sale $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
