<?php

namespace App\Filament\Resources\AppointmentResource\Pages;

use App\Filament\Resources\AppointmentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAppointment extends CreateRecord
{
    protected static string $resource = AppointmentResource::class;

    protected function afterSave(): void
    {
        $treatmentIds = $this->form->getState()['treatment_id'];
        $therapistIds = $this->form->getState()['therapist_id'];

        foreach ($treatmentIds as $treatmentId) {
            foreach ($therapistIds as $therapistId) {
                $this->record->treatments()->attach($treatmentId, ['therapist_id' => $therapistId]);
            }
        }
    }
}
