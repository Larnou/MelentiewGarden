<?php

namespace App\Filament\Resources\Seedlings\Pages;

use App\Filament\Resources\Seedlings\SeedlingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSeedlings extends ListRecords
{
    protected static string $resource = SeedlingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
