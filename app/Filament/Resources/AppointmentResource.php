<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Location;
use Filament\Forms\Form;
use App\Models\Therapist;
use App\Models\Treatment;
use Filament\Tables\Table;
use App\Models\Appointment;
use Faker\Provider\ar_EG\Text;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AppointmentResource\Pages;
use App\Filament\Resources\AppointmentResource\RelationManagers;

class AppointmentResource extends Resource
{
    protected static ?string $model = Appointment::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('name')
                        ->label('Name')
                        ->required(),
                    TextInput::make('email')
                        ->label('Email')
                        ->required(),
                    TextInput::make('phone')
                        ->label('Phone')
                        ->required(),
                    Select::make('location_id')
                        ->label('Location')
                        ->options(Location::all()->pluck('name', 'id'))
                        ->searchable()
                        ->required()
                        ->reactive()
                        ->afterStateUpdated(fn(callable $set) => $set('treatment_id', null)),
                    Select::make('treatment_id')
                        ->label('Treatments')
                        ->multiple()
                        ->options(function (callable $get) {
                            $locationId = $get('location_id');
                            if ($locationId) {
                                return Treatment::where('location_id', $locationId)->pluck('name', 'id');
                            }
                            return Treatment::all()->pluck('name', 'id');
                        })
                        ->required()
                        ->reactive()
                        ->afterStateUpdated(fn(callable $set) => $set('therapist_id', null)),
                    Select::make('therapist_id')
                        ->label('Therapists')
                        ->multiple()
                        ->options(function (callable $get) {
                            $treatmentIds = $get('treatment_id');
                            if ($treatmentIds) {
                                return Therapist::whereHas('treatments', function ($query) use ($treatmentIds) {
                                    $query->whereIn('treatment_id', $treatmentIds);
                                })->pluck('name', 'id');
                            }
                            return Therapist::all()->pluck('name', 'id');
                        })
                        ->required(),
                    DatePicker::make('date')
                        ->label('Date')
                        ->required(),
                    TimePicker::make('start_time')
                        ->label('Start Time')
                        ->required(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('location.name')
                    ->label('Location')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('start_time')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
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
            'index' => Pages\ListAppointments::route('/'),
            'create' => Pages\CreateAppointment::route('/create'),
            'view' => Pages\ViewAppointment::route('/{record}'),
            'edit' => Pages\EditAppointment::route('/{record}/edit'),
        ];
    }
}
