<?php

namespace App\Filament\Resources\SkillResource\Pages;

use App\Filament\Resources\ContentPieceResource;
use App\Filament\Resources\SkillResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSkills extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = SkillResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
