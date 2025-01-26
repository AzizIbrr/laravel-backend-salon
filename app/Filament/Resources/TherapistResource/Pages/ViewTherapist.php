<?php

namespace App\Filament\Resources\TherapistResource\Pages;

use Filament\Actions;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\TherapistResource;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;

class ViewTherapist extends ViewRecord
{
    protected static string $resource = TherapistResource::class;

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Therapist Information')
                ->schema([
                    TextEntry::make('image')->columnSpan(2),
                    TextEntry::make('name'),
                    TextEntry::make('price'),
                    TextEntry::make('rating'),
                    TextEntry::make('total_treatment'),
                ])->columns(2),
            ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
