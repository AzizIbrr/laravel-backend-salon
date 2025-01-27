<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TherapistResource extends JsonResource
{
    // Define properties
    public $status;
    public $message;
    public $resource;
    public $date;
    public $start_time;

    /**
     * __construct
     *
     * @param  mixed $status
     * @param  mixed $message
     * @param  mixed $resource
     * @return void
     */
    public function __construct($status, $message, $resource,$date, $start_time)
    {
        parent::__construct($resource);
        $this->status  = $status;
        $this->message = $message;
        $this->date = $date;
        $this->start_time = $start_time;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  Request $request
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'success'   => $this->status,
            'message'   => $this->message,
            'data'      => $this->resource->map(function ($treatment) {
                return [
                    'treatment_id' => $treatment->id,
                    'treatment_name' => $treatment->name,
                    'treatment_price' => $treatment->price,
                    'date' => $this->date,
                    'start_time' => $this->start_time,
                    'end_time' => $treatment->end_time,
                    'treatment_duration' => $treatment->duration,
                    'therapists' => $treatment->therapists->map(function ($therapist) {
                        return [
                            'id' => $therapist->id,
                            'name' => $therapist->name,
                            'price' => $therapist->price,
                            'image' => url('storage/therapist/' . $therapist->image),
                            'rating' => $therapist->rating,
                            'total_treatment' => $therapist->total_treatment,
                        ];
                    }),
                ];
            }),
        ];
    }
}
