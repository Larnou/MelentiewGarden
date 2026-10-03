<?php

namespace App\Filament\Resources\Articles;

use App\Filament\Resources\Articles\Pages\CreateArticle;
use App\Filament\Resources\Articles\Pages\EditArticle;
use App\Filament\Resources\Articles\Pages\ListArticles;
use App\Models\Article;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use App\Filament\Forms\ContentBlocks;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $navigationLabel = 'Статьи';

    protected static ?string $modelLabel = 'статья';

    protected static ?string $pluralModelLabel = 'Статьи';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('slug')
                    ->label('Адрес')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true),
                TextInput::make('title')
                    ->label('Заголовок')
                    ->required(),
                Textarea::make('meta')
                    ->label('Лид')
                    ->columnSpanFull(),
                Textarea::make('seo_description')
                    ->label('SEO-описание')
                    ->columnSpanFull(),
                CheckboxList::make('tags')
                    ->label('Теги')
                    ->options([
                        'apple' => 'Яблони',
                        'care' => 'Уход за садом',
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
                FileUpload::make('cover_path')
                    ->label('Обложка')
                    ->disk('public')
                    ->directory(fn (Get $get): string => 'articles/'.($get('slug') ?: 'draft'))
                    ->image()
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->maxSize(5120)
                    ->required(),
                TextInput::make('cover_alt')
                    ->label('Alt обложки')
                    ->required(),
                TextInput::make('sort')
                    ->label('Порядок')
                    ->numeric()
                    ->default(0),
                Toggle::make('is_published')
                    ->label('Опубликована'),
                ContentBlocks::make('articles'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                TextColumn::make('slug')
                    ->searchable(),
                TextColumn::make('title')
                    ->searchable(),
                TextColumn::make('cover_path')
                    ->searchable(),
                TextColumn::make('cover_alt')
                    ->searchable(),
                TextColumn::make('sort')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('is_published')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListArticles::route('/'),
            'create' => CreateArticle::route('/create'),
            'edit' => EditArticle::route('/{record}/edit'),
        ];
    }
}
