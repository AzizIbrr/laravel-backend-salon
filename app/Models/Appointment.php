<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'location_id',
        'date',
        'start_time',
        'status',
        'total_price',
    ];

    public function treatments()
    {
        return $this->belongsToMany(Treatment::class, 'appointment_treatment')
            ->using(AppointmentTreatment::class)
            ->withPivot('therapist_id')
            ->withTimestamps();
    }

    public function therapists()
    {
        return $this->belongsToMany(Therapist::class, 'appointment_treatment')
            ->withPivot('treatment_id')
            ->withTimestamps();
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
