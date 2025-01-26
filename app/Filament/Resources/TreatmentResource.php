<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Category;
use App\Models\Location;
use Filament\Forms\Form;
use App\Models\Treatment;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\TreatmentResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TreatmentResource\RelationManagers;

class TreatmentResource extends Resource
{
    protected static ?string $model = Treatment::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('duration')
                        ->numeric()
                        ->required(),
                    Forms\Components\Select::make('location_id')
                        ->label('Location')
                        ->options(Location::all()->pluck('name', 'id'))
                        ->searchable()
                        ->required(),
                    Forms\Components\TextInput::make('price')
                        ->numeric()
                        ->required(),
                    Forms\Components\FileUpload::make('image')
                        ->required(),
                    Forms\Components\Select::make('category_id')
                        ->label('Category')
                        ->options(Category::all()->pluck('name', 'id'))
                        ->searchable()
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
                TextColumn::make('duration')
                    ->sortable(),
                TextColumn::make('location.name')
                    ->label('Location')
                    ->sortable(),
                TextColumn::make('price')
                    ->sortable(),
                TextColumn::make('image')
                    ->sortable(),
                TextColumn::make('category.name')
                    ->label('Category')
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
            'index' => Pages\ListTreatments::route('/'),
            'create' => Pages\CreateTreatment::route('/create'),
            'view' => Pages\ViewTreatment::route('/{record}'),
            'edit' => Pages\EditTreatment::route('/{record}/edit'),
        ];
    }
}
