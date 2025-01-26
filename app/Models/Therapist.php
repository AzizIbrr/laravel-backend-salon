<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Therapist extends Model
{
    use HasFactory;

    public function treatments()
    {
        return $this->belongsToMany(Treatment::class, 'treatment_therapist')
                    ->withTimestamps();
    }

    public function appointmentTreatments()
    {
        return $this->hasMany(AppointmentTreatment::class);
    }
}
