<?php

namespace App\Filament\Resources;

use App\Enums\ContentPieceType;
use App\Filament\Resources\ContentPieceResource\Pages;
use App\Filament\Resources\ContentPieceResource\RelationManagers;
use App\Models\ContentPiece;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class ContentPieceResource extends Resource
{
    use Translatable;

    protected static ?string $model = ContentPiece::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('identifier')
                    ->label('Identifier')
                    ->required()
                    ->string(),
                Forms\Components\Select::make('type')
                    ->label('Art')
                    ->required()
                    ->options(ContentPieceType::options())
                    ->live(),
                Forms\Components\Textarea::make('text')
                    ->label(function (Get $get) {
                        return $get('type') == ContentPieceType::Image->value ? 'Alt Text' : 'Text';
                    })
                    ->hidden(fn (Get $get): bool => !in_array($get('type'), [ContentPieceType::Text->value, ContentPieceType::Image->value])),
                Forms\Components\RichEditor::make('text')
                    ->hidden(fn (Get $get): bool => $get('type') != ContentPieceType::Html->value),
                Forms\Components\SpatieMediaLibraryFileUpload::make('image')
                    ->collection('image')
                    ->hidden(fn (Get $get): bool => $get('type') != ContentPieceType::Image->value),

                Forms\Components\TextInput::make('image_conversion_width')
                    ->label('Anzeigebreite')
                    ->numeric()
                    ->hidden(fn (Get $get): bool => $get('type') != ContentPieceType::Image->value),
                Forms\Components\TextInput::make('image_conversion_height')
                    ->label('Anzeigehöhe')
                    ->numeric()
                    ->hidden(fn (Get $get): bool => $get('type') != ContentPieceType::Image->value),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('identifier')
                    ->label('Identifier')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\SpatieMediaLibraryImageColumn::make('image')
                    ->label('Bild'),
                Tables\Columns\TextColumn::make('filledTranslations')
                    ->label('Übersetzungen')
                    ->formatStateUsing(function (string $state) {
                        $arrState = json_decode($state, true);

                        return Arr::join($arrState, ", ");
                    }),
            ])
            ->filters([
                Tables\Filters\Filter::make('is_empty')
                    ->label('Ist leer')
                    ->query(fn (Builder $query) => $query->whereIn('type', [ContentPieceType::Text->value, ContentPieceType::Html->value])->whereNull('text')),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->modifyQueryUsing(function (Builder $query) {
                $query->select(['*', DB::raw('JSON_KEYS(text) AS filledTranslations')]);
            });
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
            'index' => Pages\ListContentPieces::route('/'),
            'create' => Pages\CreateContentPiece::route('/create'),
            'edit' => Pages\EditContentPiece::route('/{record}/edit'),
        ];
    }
}
