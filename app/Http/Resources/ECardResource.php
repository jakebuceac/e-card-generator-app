<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ECardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'ECard',
            'id' => $this->id,
            'attributes' => [
                'name' => $this->name,
                'thumbnail_url' => $this->thumbnail_url,
                'size' => $this->size,
                'occasion' => $this->occasion,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
            'relationships' => [
                'e_card_information' => ECardInformationResource::make($this->eCardInformation),
            ],
        ];
    }
}
