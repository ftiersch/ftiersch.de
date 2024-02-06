<?php

namespace App\Filament\Resources\ContentPieceResource\Pages;

use App\Filament\Resources\ContentPieceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListContentPieces extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = ContentPieceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
