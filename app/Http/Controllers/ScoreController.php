<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateScoreRequest;
use App\Models\Game;
use Illuminate\Http\JsonResponse;

class ScoreController extends Controller
{
    /**
     * @param UpdateScoreRequest $request
     * @param Game $game
     * @return JsonResponse
     */
    public function update(UpdateScoreRequest $request, Game $game)
    {
        try {
            $game->goals()->create([
                'player_id' => $request->get('player_id'),
                'time' => $request->get('time')
            ]);
            $game->load(['goals']);
            return $this->handleResponse($game, "The game's score was successfully updated.");
        } catch (\Exception $e) {
            return $this->handleError($e->getMessage());
        }
    }
}
