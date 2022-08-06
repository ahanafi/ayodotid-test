<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
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
            'games' => (new GameResource($this)),
            'home_team' => (new TeamResource($this->homeTeam)),
            'away_team' => (new TeamResource($this->awayTeam)),
            'winner' => (new TeamResource($this->getTheWinner)),
            'goals' => GoalResource::collection($this->goals),
            'top_scorer' => $this->getTopScorer()
        ];
    }
}
