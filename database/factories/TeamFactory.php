<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Team>
 */
class TeamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = fake('id')->name();
        $logo = str_replace(" ", "_", $name) . ".png";
        return [
            'name' => $name,
            'logo' => $logo,
            'since' => fake('id')->year(),
            'address' => fake('id')->address(),
            'city' => fake('id')->city(),
        ];
    }
}
