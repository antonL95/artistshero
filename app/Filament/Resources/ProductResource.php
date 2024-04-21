<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers\FiltersRelationManager;
use App\Models\Product;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use FilamentTiptapEditor\Enums\TiptapOutput;
use FilamentTiptapEditor\TiptapEditor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ProductResource extends Resource
{
    use Translatable;

    protected static ?string $model = Product::class;

    protected static ?string $slug = 'products';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required(),

                TiptapEditor::make('description')
                    ->profile('simple')
                    ->output(TiptapOutput::Html)
                    ->columnSpanFull()
                    ->required(),

                Select::make('artist_id')
                    ->relationship('artist', 'name')
                    ->required(),

                Select::make('filters')
                    ->relationship('filters', 'name')
                    ->multiple(),

                Hidden::make('created_by')->default(auth()->id()),

                Hidden::make('updated_by')->default(auth()->id()),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }

    /**
     * @return Builder<Product>
     */
    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['artist', 'createdBy', 'updatedBy']);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'artist.name', 'createdBy.name', 'updatedBy.name'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        $details = [];

        if (!$record instanceof Product) {
            return $details;
        }

        if ($record->artist) {
            $details['Artist'] = $record->artist->name;
        }

        if ($record->createdBy) {
            $details['CreatedBy'] = $record->createdBy->name;
        }

        if ($record->updatedBy) {
            $details['UpdatedBy'] = $record->updatedBy->name;
        }

        return $details; //@phpstan-ignore-line
    }

    public static function getRelations(): array
    {
        return [
            FiltersRelationManager::class,
        ];
    }
}
