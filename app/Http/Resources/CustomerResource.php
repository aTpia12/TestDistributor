<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
                'type' => 'customers',
                'id' => (string) $this->resource->getRouteKey(),
                'attributes' => [
                    'company_name' => $this->resource->company_name,
                    'contact_name' => $this->resource->contact_name,
                    'email' => $this->resource->email,
                    'phone' => $this->resource->phone
                ],
                'links' => [
                    'self' => route('api.v1.customers.show', $this->resource->getRouteKey())
                ]
        ];
    }
}
