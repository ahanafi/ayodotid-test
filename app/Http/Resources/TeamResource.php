<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeamResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'logo' => $this->logo,
            'since' => $this->since,
            'address' => $this->address,
            'city' => $this->city,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
