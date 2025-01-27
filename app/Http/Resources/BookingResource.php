<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class BookingResource extends JsonResource
{
    public $status;
    public $message;

    /**
     * __construct
     *
     * @param  bool   $status
     * @param  string $message
     * @param  mixed  $resource
     */
    public function __construct($status, $message, $resource)
    {
        parent::__construct($resource);
        $this->status = $status;
        $this->message = $message;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  Request $request
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $formatted_date = Carbon::parse($this->date)->format('l, d F Y');
        $formatted_time = Carbon::parse($this->start_time)->format('H:i');

        return [
            'success' => $this->status,
            'message' => $this->message,
            'data' => [
                'order_details' => [
                    'transaction_id' => $this->id_appointment ?? $this->id,
                    'customer' => $this->name,
                    'location' => $this->location->name ?? 'Unknown Location',
                    'phone_number' => $this->phone,
                    'treatment_details' => $this->treatments->map(function ($treatment) {
                        return [
                            'treatment_name' => $treatment->name,
                            'category_name' => $treatment->category->name,
                            'therapist_name' => $treatment->pivot->therapist->name ?? 'N/A',
                        ];
                    }),
                    'date' => $formatted_date,
                    'start_time' => $formatted_time,
                ],
                'payment_details' => [
                    'items' => $this->treatments->map(function ($treatment) {
                        return [
                            'name' => $treatment->name . ' (' . $treatment->category->name . ')',
                            'price' => $treatment->price,
                        ];
                    }),
                    'service_fee' => $this->service_fee ?? 0,
                    'total_price' => $this->total_price + $this->service_fee,
                ]
            ]
        ];
    }
}
