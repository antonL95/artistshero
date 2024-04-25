<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Awcodes\Curator\Components\Tables\CuratorColumn;
use Filament\Forms\Components\DatePicker;
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

class PostResource extends Resource
{
    use Translatable;

    protected static ?string $model = Post::class;

    protected static ?string $slug = 'posts';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->required(),

                TextInput::make('subtitle'),

                TiptapEditor::make('content')
                    ->columnSpanFull()
                    ->output(TiptapOutput::Html)
                    ->profile('default')
                    ->required(),

                CuratorPicker::make('thumbnail_image_id')
                    ->size('sm')
                    ->relationship('thumbnail', 'id')
                    ->required(),

                CuratorPicker::make('cover_image_id')
                    ->relationship('coverImage', 'id')
                    ->required(),

                CuratorPicker::make('image_ids')
                    ->multiple()
                    ->relationship('images', 'id'),

                DatePicker::make('published_at')
                    ->label('Published Date'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                CuratorColumn::make('thumbnail')
                    ->size(40)
                    ->circular(),

                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('subtitle'),

                TextColumn::make('published_at')
                    ->label('Published Date')
                    ->date(),
                CuratorColumn::make('coverImage')
                    ->size(40)
                    ->circular(),
                CuratorColumn::make('images')
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }

    /**
     * @return Builder<Post>
     */
    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['createdBy', 'updateBy']);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['title', 'createdBy.name', 'updateBy.name'];
    }

    /**
     * @param Post $record
     */
    public static function getGlobalSearchResultDetails(Model $record): array
    {
        $details = [];

        if ($record->createdBy) {
            $details['CreatedBy'] = $record->createdBy->name;
        }

        return $details;
    }
}
