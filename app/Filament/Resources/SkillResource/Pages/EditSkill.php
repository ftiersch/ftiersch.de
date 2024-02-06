<?php

namespace App\Filament\Resources\SkillResource\Pages;

use App\Filament\Resources\ContentPieceResource;
use App\Filament\Resources\SkillResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\EditRecord\Concerns\Translatable;

class EditSkill extends EditRecord
{
    use Translatable;

    protected static string $resource = SkillResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
