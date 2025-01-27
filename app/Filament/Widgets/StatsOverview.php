<?php

namespace App\Filament\Widgets;

use App\Models\Appointment;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Appointments', Appointment::count()),
            // Stat::make('Treatments', 'App\Models\Treatment')->count(),
            // Stat::make('Therapists', 'App\Models\Therapist')->count(),
            // Stat::make('Locations', 'App\Models\Location')->count(),
            // Stat::make('Categories', 'App\Models\Category')->count(),
        ];
    }
}
