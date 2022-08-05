<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePlayerRequest;
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
        $players = Player::paginate(10);
        return \response()->json([
            'success' => true,
            'data' => $players
        ]);
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
            Player::create($request->all());
            return \response()->json([
                'success' => true,
                'message' => 'New player successfully created.'
            ], 201);
        } catch (\Exception $e) {
            return \response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
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
        return \response()->json([
            'success' => true,
            'data' => $player
        ]);
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
            return \response()->json([
                'success' => true,
                'message' => 'Player was successfully updated.'
            ]);
        } catch (\Exception $e) {
            return \response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
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
            return \response()->json([
                'success' => true,
                'message' => 'Player was successfully deleted.'
            ]);
        } catch (\Exception $e) {
            return \response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
