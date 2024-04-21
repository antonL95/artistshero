<?php

declare(strict_types=1);

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use App\Models\Post;
use App\Models\Product;
use Filament\Actions\CreateAction;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListProducts extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = ProductResource::class;



    /**
     * @return Builder<Product>|null
     */
    protected function getTableQuery(): ?Builder
    {
        return parent::getTableQuery()?->with(['images']);
    }
    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
            CreateAction::make(),
        ];
    }
}
