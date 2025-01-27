<?php

namespace App\Http\Controllers\Api;

use App\Models\Treatment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TherapistResource;
use App\Http\Resources\TreatmentResource;

class TreatmentController extends Controller
{
    public function index()
    {
        $treatments = Treatment::all();
        return new TreatmentResource(true, 'List Data Treatments', $treatments);
    }

    public function getTreatmentByLocation(Request $request)
    {
        $location_id = $request->query('location_id');
        $treatments = Treatment::where('location_id', $location_id)->get();
        if ($treatments->isNotEmpty()) {
            return new TreatmentResource(true, 'Data Treatments', $treatments);
        } else {
            return new TreatmentResource(false, 'No Treatments Found for this Location', null);
        }
    }

    public function getTherapistByTreatment(Request $request)
    {
        $location_id = $request->input('location_id');
        $booking_id = $request->input('booking_id');
        $date = $request->input('date');
        $start_time = $request->input('start_time');
        $treatment_ids = $request->input('treatment_id');

        if (!is_array($treatment_ids)) {
            $treatment_ids = explode(',', $treatment_ids);
        }

        $treatments = Treatment::whereIn('id', $treatment_ids)
            ->where('location_id', $location_id)
            ->with('therapists')
            ->get();

        foreach ($treatments as $treatment) {
            $treatment->end_time = date('H:i:s', strtotime($start_time . ' +' . $treatment->duration . ' minutes'));
        }

        if ($treatments->isNotEmpty()) {
            return new TherapistResource(true, 'Data Therapists', $treatments, $date, $start_time);
        } else {
            return new TherapistResource(false, 'No Treatments Found', collect(), $date, $start_time);
        }
    }
}
