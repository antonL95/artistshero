<?php

declare(strict_types=1);

namespace App\Filament\Resources\ArtistResource\Pages;

use App\Filament\Resources\ArtistResource;
use App\Models\Artist;
use Filament\Actions\CreateAction;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListArtists extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = ArtistResource::class;

    /**
     * @return Builder<Artist>|null
     */
    protected function getTableQuery(): ?Builder
    {
        return parent::getTableQuery()?->with(['profileImage', 'coverImage', 'otherImages']);
    }

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
            CreateAction::make(),
        ];
    }
}
