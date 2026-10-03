<?php

namespace App\Filament\Resources\Seedlings;

use App\Filament\Resources\Seedlings\Pages\CreateSeedling;
use App\Filament\Resources\Seedlings\Pages\EditSeedling;
use App\Filament\Resources\Seedlings\Pages\ListSeedlings;
use App\Models\Seedling;
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

class SeedlingResource extends Resource
{
    protected static ?string $model = Seedling::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $navigationLabel = 'Саженцы';

    protected static ?string $modelLabel = 'саженец';

    protected static ?string $pluralModelLabel = 'Саженцы';

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
                    ->label('Заголовок страницы')
                    ->required(),
                Textarea::make('seo_description')
                    ->label('SEO-описание')
                    ->columnSpanFull(),
                TextInput::make('card_title')
                    ->label('Заголовок карточки')
                    ->required(),
                TextInput::make('card_subtitle')
                    ->label('Подзаголовок карточки'),
                TextInput::make('home_title')
                    ->label('Заголовок на главной'),
                TextInput::make('home_subtitle')
                    ->label('Подзаголовок на главной'),
                TextInput::make('price')
                    ->label('Цена')
                    ->required(),
                CheckboxList::make('tags')
                    ->label('Теги')
                    ->options([
                        'seed' => 'Семечковые',
                        'stone' => 'Косточковые',
                        'berry' => 'Ягодные',
                        'decor' => 'Декоративные',
                        'indoor' => 'Комнатные',
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
                FileUpload::make('cover_path')
                    ->label('Обложка')
                    ->disk('public')
                    ->directory(fn (Get $get): string => 'seedlings/'.($get('slug') ?: 'draft'))
                    ->image()
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->maxSize(5120)
                    ->required(),
                TextInput::make('cover_alt')
                    ->label('Alt обложки')
                    ->required(),
                Toggle::make('show_on_home')
                    ->label('На главной'),
                TextInput::make('home_sort')
                    ->label('Порядок на главной')
                    ->numeric()
                    ->default(0),
                TextInput::make('sort')
                    ->label('Порядок в каталоге')
                    ->numeric()
                    ->default(0),
                Toggle::make('is_published')
                    ->label('Опубликован'),
                ContentBlocks::make('seedlings'),
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
                TextColumn::make('card_title')
                    ->searchable(),
                TextColumn::make('card_subtitle')
                    ->searchable(),
                TextColumn::make('home_title')
                    ->searchable(),
                TextColumn::make('home_subtitle')
                    ->searchable(),
                TextColumn::make('price')
                    ->searchable(),
                TextColumn::make('cover_path')
                    ->searchable(),
                TextColumn::make('cover_alt')
                    ->searchable(),
                IconColumn::make('show_on_home')
                    ->boolean(),
                TextColumn::make('home_sort')
                    ->numeric()
                    ->sortable(),
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
            'index' => ListSeedlings::route('/'),
            'create' => CreateSeedling::route('/create'),
            'edit' => EditSeedling::route('/{record}/edit'),
        ];
    }
}
