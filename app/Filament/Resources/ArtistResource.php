<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\ArtistResource\Pages;
use App\Models\Artist;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Awcodes\Curator\Components\Tables\CuratorColumn;
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
use FilamentTiptapEditor\Enums\TiptapOutput;
use FilamentTiptapEditor\TiptapEditor;

class ArtistResource extends Resource
{
    use Translatable;

    protected static ?string $model = Artist::class;

    protected static ?string $slug = 'artists';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required(),

                TiptapEditor::make('bio')
                    ->columnSpanFull()
                    ->output(TiptapOutput::Html)
                    ->profile('simple')
                    ->required(),

                CuratorPicker::make('profile_image_id')
                    ->size('sm')
                    ->relationship('profileImage', 'id')
                    ->required(),

                CuratorPicker::make('cover_image_id')
                    ->relationship('coverImage', 'id')
                    ->required(),

                CuratorPicker::make('other_image_ids')
                    ->multiple()
                    ->relationship('otherImages', 'id'),

                Hidden::make('created_by')->default(auth()->id()),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                CuratorColumn::make('profileImage')
                    ->size(40)
                    ->circular(),
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                CuratorColumn::make('coverImage')
                    ->size(40)
                    ->circular(),
                CuratorColumn::make('otherImages')
                    ->size(40)
                    ->circular(),
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
            'index' => Pages\ListArtists::route('/'),
            'create' => Pages\CreateArtist::route('/create'),
            'edit' => Pages\EditArtist::route('/{record}/edit'),
        ];
    }
}
