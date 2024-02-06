<?php

namespace App\Filament\Exports;

use App\Models\Skill;
use Filament\Actions\Exports\Enums\ExportFormat;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class SkillExporter extends Exporter
{
    protected static ?string $model = Skill::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('name')
                ->label('Name'),
            ExportColumn::make('percent')
                ->label('Prozent'),
            ExportColumn::make('sort')
                ->label('Sortierung'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public function getFormats(): array
    {
        return [
            ExportFormat::Csv,
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your skill export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
