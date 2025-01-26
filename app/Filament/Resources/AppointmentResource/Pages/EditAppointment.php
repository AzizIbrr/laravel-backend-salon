<?php

namespace App\Filament\Resources\AppointmentResource\Pages;

use App\Filament\Resources\AppointmentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAppointment extends EditRecord
{
    protected static string $resource = AppointmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        $treatmentIds = $this->form->getState()['treatment_id'];
        $therapistIds = $this->form->getState()['therapist_id'];

        $syncData = [];
        foreach ($treatmentIds as $treatmentId) {
            foreach ($therapistIds as $therapistId) {
                $syncData[$treatmentId] = ['therapist_id' => $therapistId];
            }
        }

        $this->record->treatments()->sync($syncData);
    }
}
