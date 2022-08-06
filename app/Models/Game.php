<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Expression;

class Game extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'home',
        'away',
        'date',
        'time',
        'status',
        'home_score',
        'away_score',
        'winner'
    ];

    public function homeTeam(): HasOne
    {
        return $this->hasOne(Team::class, 'id', 'home');
    }

    public function awayTeam(): HasOne
    {
        return $this->hasOne(Team::class, 'id', 'away');
    }

    public function goals(): HasMany
    {
        return $this->hasMany(Goal::class, 'game_id');
    }

    public function getSchedule(): string
    {
        return $this->attributes['date'] . " " . $this->attributes['time'];
    }

    public function getTheWinner(): ?HasOne
    {
        $homeScore = $this->attributes['home_score'];
        $awayScore = $this->attributes['away_score'];

        if ($homeScore > $awayScore) {
            return $this->homeTeam();
        } else if ($homeScore < $awayScore) {
            return $this->awayTeam();
        } else {
            return null;
        }
    }

    public function getTopScorer(): Model|Builder|null
    {
        return self::query()->selectRaw("COUNT(goals.player_id) AS totalGoal, goals.player_id")
            ->from($this->table)
            ->join('goals', 'goals.game_id', $this->table . '.' . $this->primaryKey)
            ->where('game_id', $this->attributes['id'])
            ->groupBy('player_id')
            ->orderBy('totalGoal', 'desc')
            ->limit(1)
            ->first();
    }
}
