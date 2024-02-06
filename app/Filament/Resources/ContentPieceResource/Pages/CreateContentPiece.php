<?php

namespace App\Filament\Resources\ContentPieceResource\Pages;

use App\Filament\Resources\ContentPieceResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\CreateRecord\Concerns\Translatable;

class CreateContentPiece extends CreateRecord
{
    use Translatable;

    protected static string $resource = ContentPieceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
