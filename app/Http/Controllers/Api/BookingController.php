<?php

namespace App\Http\Controllers\Api;

use App\Models\Therapist;
use App\Models\Treatment;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AppointmentTreatment;
use App\Http\Resources\BookingResource;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $total_price = 0;

        foreach ($request->detail as $detail) {
            $treatment = Treatment::find($detail['treatment_id']);
            $therapist = Therapist::find($detail['therapist_id']);
            $total_price += $treatment->price + $therapist->price;
        }

        $booking = Appointment::create([
            'location_id' => $request->branch_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'date' => $request->date,
            'start_time' => $request->start_time,
            'status' => 'pending', // or any default status
            'total_price' => $total_price,
        ]);

        foreach ($request->detail as $detail) {
            $booking->treatments()->attach($detail['treatment_id'], ['therapist_id' => $detail['therapist_id']]);
        }

        return new BookingResource(true, 'Booking Success', $booking);
    }
}
