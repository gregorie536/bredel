<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChildPresenceResource\Pages;
use App\Filament\Resources\ChildPresenceResource\RelationManagers;
use App\Models\ChildPresence;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ChildPresenceResource extends Resource
{
    protected static ?string $model = ChildPresence::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('child_id')
                    ->relationship('child', 'name')
                    ->required(),
                Forms\Components\Toggle::make('present')
                    ->label('Présent')
                    ->default(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('child.name')
                    ->label('Enfant')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\BooleanColumn::make('present')
                    ->label('Présent'),
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
            ]);
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
            'index' => Pages\ListChildPresences::route('/'),
            'create' => Pages\CreateChildPresence::route('/create'),
            'edit' => Pages\EditChildPresence::route('/{record}/edit'),
        ];
    }
}
