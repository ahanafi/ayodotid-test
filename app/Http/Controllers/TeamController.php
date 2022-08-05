<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeamRequest;
use App\Http\Resources\TeamResource;
use App\Models\Team;
use Illuminate\Http\JsonResponse;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $teams = Team::all();
        return $this->handleResponse(TeamResource::collection($teams));
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
            $team = Team::create($request->all());
            return $this->handleResponse(new TeamResource($team), 'New team successfully created.');
        } catch (\Exception $e) {
            return $this->handleError($e->getMessage());
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
        return $this->handleResponse(new TeamResource($team));
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
            return $this->handleResponse(new TeamResource($team), 'Team was successfully updated.');
        } catch (\Exception $e) {
            return $this->handleError($e->getMessage());
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
            return $this->handleResponse([], 'Team was successfully deleted.');
        } catch (\Exception $e) {
            return $this->handleError($e->getMessage());
        }
    }
}
