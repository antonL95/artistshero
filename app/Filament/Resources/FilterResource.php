<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\FilterResource\Pages;
use App\Models\Filter;
use Filament\Forms\Components\Hidden;
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
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class FilterResource extends Resource
{
    use Translatable;

    protected static ?string $model = Filter::class;

    protected static ?string $slug = 'filters';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required(),

                TextInput::make('type')
                    ->required(),

                Hidden::make('created_by')->default(auth()->id()),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('type'),
            ])
            ->filters([

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
            'index' => Pages\ListFilters::route('/'),
            'create' => Pages\CreateFilter::route('/create'),
            'edit' => Pages\EditFilter::route('/{record}/edit'),
        ];
    }

    /**
     * @return Builder<Filter>
     */
    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['createdBy', 'updatedBy']);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'createdBy.name', 'updatedBy.name'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        $details = [];

        if (!$record instanceof Filter) {
            return $details;
        }

        if ($record->createdBy) {
            $details['CreatedBy'] = $record->createdBy->name;
        }

        if ($record->updatedBy) {
            $details['UpdatedBy'] = $record->updatedBy->name;
        }

        return $details;
    }
}
