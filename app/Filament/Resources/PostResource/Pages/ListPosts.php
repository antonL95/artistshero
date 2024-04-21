<?php

declare(strict_types=1);

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use App\Models\Post;
use Filament\Actions\CreateAction;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListPosts extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = PostResource::class;

    /**
     * @return Builder<Post>|null
     */
    protected function getTableQuery(): ?Builder
    {
        return parent::getTableQuery()?->with(['thumbnail', 'coverImage', 'images']);
    }

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
            CreateAction::make(),
        ];
    }
}
