<?php

namespace Database\Factories;

use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Player>
 */
class PlayerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $arrPositions = ['ATTACKER', 'MIDFIELDER', 'DEFENDER', 'GOALKEEPER'];

        $team = Team::query()
            ->select('id')
            ->orderByRaw(DB::raw('RAND()'))
            ->first();

        $teamId = $team->id;

        return [
            'name' => fake('id')->name(),
            'height' => fake()->numberBetween(160, 200),
            'weight' => fake()->numberBetween(60, 75),
            'position' => $arrPositions[array_rand($arrPositions)],
            'number' => fake()->numberBetween(1, 99),
            'team_id' => $teamId
        ];
    }
}
