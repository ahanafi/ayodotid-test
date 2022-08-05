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
            $game->score()->create([
                'player_id' => $request->get('player_id'),
                'goal_at' => $request->get('goal_at')
            ]);
            $game->load(['score']);
            return $this->handleResponse($game, "The game's score was successfully updated.");
        } catch (\Exception $e) {
            return $this->handleError($e->getMessage());
        }
    }
}
