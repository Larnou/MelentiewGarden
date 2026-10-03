<?php

namespace App\Filament\Resources\Seedlings\Pages;

use App\Filament\Resources\Seedlings\SeedlingResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSeedling extends EditRecord
{
    protected static string $resource = SeedlingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
