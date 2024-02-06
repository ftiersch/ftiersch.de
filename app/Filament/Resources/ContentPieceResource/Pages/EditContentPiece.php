<?php

namespace App\Filament\Resources\ContentPieceResource\Pages;

use App\Filament\Resources\ContentPieceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\EditRecord\Concerns\Translatable;

class EditContentPiece extends EditRecord
{
    use Translatable;

    protected static string $resource = ContentPieceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
