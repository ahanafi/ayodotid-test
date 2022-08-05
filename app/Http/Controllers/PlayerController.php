<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePlayerRequest;
use App\Http\Resources\PlayerResource;
use App\Models\Player;
use Illuminate\Http\JsonResponse;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $players = Player::all();
        return $this->handleResponse(PlayerResource::collection($players));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePlayerRequest $request
     * @return JsonResponse
     */
    public function store(StorePlayerRequest $request)
    {
        try {
            $player = Player::create($request->all());
            return $this->handleResponse(new PlayerResource($player) , 'New player successfully created.');
        } catch (\Exception $e) {
            return $this->handleError($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Player $player
     * @return JsonResponse
     */
    public function show(Player $player)
    {
        return $this->handleResponse(new PlayerResource($player));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StorePlayerRequest $request
     * @param Player $player
     * @return JsonResponse
     */
    public function update(StorePlayerRequest $request, Player $player)
    {
        try {
            $player->update($request->all());
            return $this->handleResponse(new PlayerResource($player), 'Player was successfully updated.');
        } catch (\Exception $e) {
            return $this->handleError($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Player $player
     * @return JsonResponse
     */
    public function destroy(Player $player)
    {
        try {
            $player->delete();
            return $this->handleResponse([], 'Player was successfully deleted.');
        } catch (\Exception $e) {
            return $this->handleError($e->getMessage());
        }
    }
}
