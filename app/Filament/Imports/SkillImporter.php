<?php

namespace App\Filament\Imports;

use App\Models\Skill;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class SkillImporter extends Importer
{
    protected static ?string $model = Skill::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('id')
                ->requiredMapping()
                ->rules(['required', 'integer']),
            ImportColumn::make('name')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('percent')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('sort')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
        ];
    }

    public function resolveRecord(): ?Skill
    {
        return Skill::firstOrNew([
                'id' => $this->data['id'],
            ]);
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your skill import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
