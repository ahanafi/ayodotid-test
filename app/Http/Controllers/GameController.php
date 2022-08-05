<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGameRequest;
use App\Http\Resources\GameResource;
use App\Models\Game;
use Illuminate\Http\JsonResponse;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $games = Game::all();
        return $this->handleResponse(GameResource::collection($games));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreGameRequest $request
     * @return JsonResponse
     */
    public function store(StoreGameRequest $request)
    {
        try {
            $game = Game::create($request->all());
            return $this->handleResponse(new GameResource($game), 'The game was successfully created.');
        } catch (\Exception $e) {
            return $this->handleError($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Game $game
     * @return JsonResponse
     */
    public function show(Game $game)
    {
        return $this->handleResponse(new GameResource($game));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreGameRequest $request
     * @param Game $game
     * @return JsonResponse
     */
    public function update(StoreGameRequest $request, Game $game)
    {
        try {
            $game->update($request->all());
            return $this->handleResponse(new GameResource($game), 'The game was successfully updated.');
        } catch (\Exception $e) {
            return $this->handleError($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Game $game
     * @return JsonResponse
     */
    public function destroy(Game $game)
    {
        try {
            $game->delete();
            return $this->handleResponse([], 'The game was successfully deleted.');
        } catch (\Exception $e) {
            return $this->handleError($e->getMessage());
        }
    }
}
