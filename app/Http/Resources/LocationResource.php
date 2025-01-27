<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LocationResource extends JsonResource
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
            'data'      => $this->resource
        ];
    }
}
