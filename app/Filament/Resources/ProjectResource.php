<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\RelationManagers;
use App\Models\Project;
use App\Models\ProjectCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProjectResource extends Resource
{
    use Translatable;

    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(1)
                    ->schema([
                        Forms\Components\Select::make('project_category_id')
                            ->label('Typ')
                            ->relationship('category')
                            ->getOptionLabelFromRecordUsing(fn (ProjectCategory $record) => $record->title)
                            ->required(),
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\Checkbox::make('visible_on_website')
                                    ->label('Website'),
                                Forms\Components\Checkbox::make('visible_in_pdf')
                                    ->label('PDF'),
                            ]),
                    ]),
                Forms\Components\Section::make('Daten')
                    ->columns(2)
                    ->schema([
                        Forms\Components\DatePicker::make('started_at')
                            ->label('Von')
                            ->required(),
                        Forms\Components\DatePicker::make('finished_at')
                            ->label('Bis')
                            ->nullable(),
                    ]),
                Forms\Components\Section::make('Texte')
                    ->columns(1)
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Titel')
                            ->required(),
                        Forms\Components\TextInput::make('location')
                            ->label('Ort')
                            ->required(),
                        Forms\Components\Textarea::make('description')
                            ->label('Beschreibung')
                            ->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('started_at')
                    ->label('Von')
                    ->date('m.Y'),
                Tables\Columns\TextColumn::make('finished_at')
                    ->label('Bis')
                    ->date('m.Y'),
                Tables\Columns\TextColumn::make('title')
                    ->label('Titel'),
                Tables\Columns\TextColumn::make('location')
                    ->label('Ort'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultGroup(
                Tables\Grouping\Group::make('project_category_id')
                    ->label('Kategorie')
                    ->getTitleFromRecordUsing(fn (Project $record): string => $record->category->title)
                    ->collapsible()
            );
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
