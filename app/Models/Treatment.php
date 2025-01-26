<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Treatment extends Model
{
    use HasFactory;

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function appointments()
    {
        return $this->belongsToMany(Appointment::class, 'appointment_treatment')
                    ->withPivot('therapist_id')
                    ->withTimestamps();
    }

    public function therapists()
    {
        return $this->belongsToMany(Therapist::class, 'treatment_therapist')
                    ->withTimestamps();
    }
}
