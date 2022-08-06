<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateScoreRequest;
use App\Models\Game;
use App\Models\Player;
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
        // Validate player_id
        $player = Player::find($request->get('player_id'));
        if(!in_array($player->team_id, [$game->home, $game->away])) {
            return $this->handleError('The player is unknown.');
        }

        try {
            $game->goals()->create([
                'player_id' => $request->get('player_id'),
                'time' => $request->get('time')
            ]);
            $game->load(['goals']);
            return $this->handleResponse($game->goals, "The game's score was successfully updated.");
        } catch (\Exception $e) {
            return $this->handleError($e->getMessage());
        }
    }
}
