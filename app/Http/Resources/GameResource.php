<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GameResource extends JsonResource
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
            'id' => $this->id,
            'home' => $this->home,
            'away' => $this->away,
            'date' => $this->date,
            'time' => $this->time,
            'status' => $this->status,
            'home_score' => $this->home_score,
            'away_score' => $this->away_score,
            'winner' => $this->winner
        ];
    }
}
