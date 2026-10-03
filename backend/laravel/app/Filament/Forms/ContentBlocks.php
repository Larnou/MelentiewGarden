<?php

namespace App\Filament\Forms;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;

class ContentBlocks
{
    /**
     * @return array<string, string>
     */
    public static function types(): array
    {
        return [
            'text' => 'Текст',
            'heading_text' => 'Заголовок и текст',
            'list_ordered' => 'Нумерованный список',
            'list_unordered' => 'Маркированный список',
            'media_left' => 'Картинка слева',
            'media_right' => 'Картинка справа',
            'slider' => 'Слайдер',
            'slider_captions' => 'Слайдер с подписями',
        ];
    }

    public static function make(string $directory): Repeater
    {
        return Repeater::make('blocks')
            ->label('Блоки')
            ->addActionLabel('Добавить блок')
            ->reorderable()
            ->collapsible()
            ->itemLabel(fn (array $state): string => self::types()[$state['type'] ?? ''] ?? 'Новый блок')
            ->schema([
                Select::make('type')
                    ->label('Тип')
                    ->options(self::types())
                    ->required()
                    ->live(),
                TextInput::make('title')
                    ->label('Заголовок')
                    ->required()
                    ->visible(fn (Get $get): bool => $get('type') === 'heading_text'),
                Repeater::make('paragraphs')
                    ->label('Абзацы')
                    ->simple(Textarea::make('paragraph')->label('Абзац')->required())
                    ->addActionLabel('Добавить абзац')
                    ->reorderable()
                    ->visible(fn (Get $get): bool => in_array($get('type'), ['text', 'heading_text', 'media_left', 'media_right'], true)),
                Repeater::make('items')
                    ->label('Пункты')
                    ->simple(TextInput::make('item')->label('Пункт')->required())
                    ->addActionLabel('Добавить пункт')
                    ->reorderable()
                    ->visible(fn (Get $get): bool => in_array($get('type'), ['list_ordered', 'list_unordered'], true)),
                self::imageUpload('path', $directory)
                    ->label('Картинка')
                    ->required()
                    ->visible(fn (Get $get): bool => in_array($get('type'), ['media_left', 'media_right'], true)),
                TextInput::make('alt')
                    ->label('Alt')
                    ->required()
                    ->visible(fn (Get $get): bool => in_array($get('type'), ['media_left', 'media_right'], true)),
                Repeater::make('slides')
                    ->label('Слайды')
                    ->addActionLabel('Добавить слайд')
                    ->reorderable()
                    ->collapsible()
                    ->visible(fn (Get $get): bool => in_array($get('type'), ['slider', 'slider_captions'], true))
                    ->schema([
                        self::imageUpload('path', $directory)
                            ->label('Картинка')
                            ->required(),
                        TextInput::make('alt')
                            ->label('Alt')
                            ->required(),
                        TextInput::make('caption')
                            ->label('Подпись')
                            ->visible(fn (Get $get): bool => $get('../../type') === 'slider_captions'),
                    ]),
            ])
            ->columnSpanFull();
    }

    private static function imageUpload(string $name, string $directory): FileUpload
    {
        return FileUpload::make($name)
            ->disk('public')
            ->directory(fn (Get $get): string => $directory.'/'.($get('slug') ?: $get('../slug') ?: $get('../../slug') ?: $get('../../../slug') ?: 'draft'))
            ->image()
            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
            ->maxSize(5120);
    }
}
