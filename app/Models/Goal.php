<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Goal extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'game_id',
        'player_id',
        'time'
    ];

    public static function boot()
    {
        parent::boot();
        Goal::saved(function ($goal) {
            $playerTeamId = $goal->player->team_id;
            $columns = $playerTeamId === $goal->game->home ? 'home_score' : ($playerTeamId === $goal->game->away ? 'away_score' : null);
            if ($columns !== null) {
                $goal->game()->update([
                    $columns => ($goal->game->{$columns} + 1)
                ]);
            }

            $goal->game->updateTheWinner();
        });
    }

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }
}
