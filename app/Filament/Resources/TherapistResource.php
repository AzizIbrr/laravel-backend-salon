<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Therapist;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\TherapistResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TherapistResource\RelationManagers;

class TherapistResource extends Resource
{
    protected static ?string $model = Therapist::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('price')
                        ->numeric()
                        ->required(),
                    Forms\Components\FileUpload::make('image')
                        ->required(),
                    Forms\Components\TextInput::make('rating')
                        ->numeric()
                        ->required(),
                    Forms\Components\TextInput::make('total_treatment')
                        ->numeric()
                        ->required(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('price')
                    ->sortable(),
                TextColumn::make('image')
                    ->sortable(),
                TextColumn::make('rating')
                    ->sortable(),
                TextColumn::make('total_treatment')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListTherapists::route('/'),
            'create' => Pages\CreateTherapist::route('/create'),
            'view' => Pages\ViewTherapist::route('/{record}'),
            'edit' => Pages\EditTherapist::route('/{record}/edit'),
        ];
    }
}
