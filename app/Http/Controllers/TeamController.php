<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeamRequest;
use App\Models\Team;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $teams = Team::paginate(100);
        return \response()->json([
            'success' => true,
            'data' => $teams
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTeamRequest $request
     * @return JsonResponse
     */
    public function store(StoreTeamRequest $request)
    {
        try {
            Team::create($request->all());
            return \response()->json([
                'success' => true,
                'message' => 'New team successfully created.'
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
     * @param Team $team
     * @return JsonResponse
     */
    public function show(Team $team)
    {
        return \response()->json([
            'success' => true,
            'data' => $team
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreTeamRequest $request
     * @param Team $team
     * @return JsonResponse
     */
    public function update(StoreTeamRequest $request, Team $team)
    {
        try {
            $team->update($request->all());
            return \response()->json([
                'success' => true,
                'message' => 'Team was successfully updated.'
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
     * @param Team $team
     * @return JsonResponse
     */
    public function destroy(Team $team)
    {
        try {
            $team->delete();
            return \response()->json([
                'success' => true,
                'message' => 'Team was successfully deleted.'
            ]);
        } catch (\Exception $e) {
            return \response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
