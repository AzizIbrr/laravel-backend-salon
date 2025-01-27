<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TreatmentResource extends JsonResource
{
    // Define properties
    public $status;
    public $message;
    public $resource;

    /**
     * Transform the resource into an array.
     * @param  mixed $status
     * @param  mixed $message
     * @param  mixed $resource
     * @return void
     * @return array<string, mixed>
     */

    public function __construct($status, $message, $resource)
    {
        parent::__construct($resource);
        $this->status  = $status;
        $this->message = $message;
    }

    public function toArray(Request $request): array
    {
        return [
            'success'   => $this->status,
            'message'   => $this->message,
            'data'      => [
                'treatment' => $this->resource->map(function ($treatment) {
                    return [
                        'id' => $treatment->id,
                        'name' => $treatment->name,
                        'duration' => $treatment->duration,
                        'location_id' => $treatment->location_id,
                        'location_name' => $treatment->location->name,
                        'price' => $treatment->price,
                        'image' => url('storage/treatment/' . $treatment->image),
                        'category' => [
                            'id' => $treatment->category->id,
                            'name' => $treatment->category->name,
                            'created_at' => $treatment->category->created_at,
                            'updated_at' => $treatment->category->updated_at,
                            'deleted_at' => $treatment->category->deleted_at,
                        ],

                    ];
                }),
            ],
        ];
    }
}
