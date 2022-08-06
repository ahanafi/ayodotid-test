<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReportResource;
use App\Models\Game;

class ReportController extends Controller
{
    public function index(Game $game)
    {
        $game->load([
            'homeTeam', 'awayTeam', 'goals'
        ]);

        return $this->handleResponse(
            new ReportResource($game)
        );
    }
}
