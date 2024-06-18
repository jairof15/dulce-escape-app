<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Enums\DocumentTypes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;

use MoonShine\Fields\Email;
use MoonShine\Fields\Enum;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<Customer>
 */
class CustomerResource extends ModelResource
{
    protected string $model = Customer::class;

    protected string $title = 'Clientes';

    protected string $icon = 'fas fa-user';

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
                Text::make('Nombre:', 'name')
                    ->sortable()->required()
                    ->placeholder('Nombre del cliente.'),
                Text::make('Apellido:', 'last_name')
                    ->sortable()->required()
                    ->placeholder('Apellido del cliente.'),
                Text::make('Documento:', 'document')
                    ->required()
                    ->placeholder('Documento del cliente.'),
                Enum::make('Tipo de Documento:', 'document_type')
                    ->attach(DocumentTypes::class)
                    //->options(['CI', 'Passport', 'NIT'])->required()
                    ->default('CI')->nullable()
                    ->placeholder('Tipo de documento del cliente.'),
                Email::make('Correo:', 'email')
                    ->sortable()->nullable()->default('-')
                    ->placeholder('Correo del cliente.'),
                Text::make('Teléfono:', 'phone')
                    ->nullable()->mask('+(999) 999-99999')
                    ->placeholder('Teléfono del cliente.'),
                Text::make('Dirección:', 'address')
                    ->nullable()
                    ->placeholder('Dirección del cliente.'),
            ]),
        ];
    }

    /**
     * @param Customer $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
