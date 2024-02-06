<?php

namespace App\Filament\Resources\SkillResource\Pages;

use App\Filament\Resources\ContentPieceResource;
use App\Filament\Resources\SkillResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\CreateRecord\Concerns\Translatable;

class CreateSkill extends CreateRecord
{
    use Translatable;

    protected static string $resource = SkillResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
