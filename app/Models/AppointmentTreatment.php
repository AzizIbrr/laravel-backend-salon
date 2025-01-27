<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class AppointmentTreatment extends Pivot
{
    protected $table = 'appointment_treatment';

    protected $fillable = ['appointment_id', 'treatment_id', 'therapist_id'];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function treatment()
    {
        return $this->belongsTo(Treatment::class);
    }

    public function therapist()
    {
        return $this->belongsTo(Therapist::class);
    }
}